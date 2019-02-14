<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Mail\NotifyShipped;
use App\Repositories\ContentRepository;
use App\Repositories\PresentRepository;
use App\Repositories\RoomRepository;
use App\Repositories\RoomUserRepository;
use App\Repositories\UserPresentRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class RoomController extends AppBaseController
{
    /** @var  PresentRepository */
    private $presentRepository;

    /** @var  RoomRepository */
    private $roomRepository;

    private $contentRepository;

    /** @var  UserPresentRepository */
    private $userPresentRepository;

    /** @var  UserRepository */
    private $userRepository;

    /** @var  RoomUserRepository */
    private $roomUserRepository;

    public function __construct(ContentRepository $contentRepo, UserPresentRepository $userPresentRepo, PresentRepository $presentRepo, RoomRepository $roomRepo, UserRepository $userRepo, RoomUserRepository $roomUserRepo)
    {
        $this->roomRepository = $roomRepo;
        $this->userRepository = $userRepo;
        $this->presentRepository = $presentRepo;
        $this->roomUserRepository = $roomUserRepo;
        $this->userPresentRepository = $userPresentRepo;
        $this->contentRepository = $contentRepo;
    }

    public function email($roomId, Request $request)
    {
        $room = $this->roomRepository->findWithoutFail($roomId);

        if (empty($room)) {
            Flash::error('Room not found');

            return redirect(route('rooms.index'));
        }

        $contents = $this->contentRepository->all();
        $contents = $contents->mapWithKeys(function ($item) {
            return [$item->id => $item->title];
        });

        $students = $room->roomUsers;
        $advisors = $room->roomAdvisors;

        return view('rooms.email')->with('room', $room)
            ->with('students', $students)
            ->with('advisors', $advisors)
            ->with('contents', $contents);

    }

    public function emailSend($roomId, Request $request)
    {
        $room = $this->roomRepository->findWithoutFail($roomId);
        $sendToStudent = (boolean) $request->input('send_to_student');
        $sendToAdvisor = (boolean) $request->input('send_to_advisor');
        if (empty($room)) {
            Flash::error('Room not found');

            return redirect(route('rooms.index'));
        }

        $content = $this->contentRepository->findWithoutFail($request->input('content_id'));

        if ($sendToStudent) {
            # student notify
            $roomUsers = $room->roomUsers;
            $userMailCc = [];
            $userMailTo = '';
            foreach ($roomUsers as $key => $roomUser) {
                $user = $roomUser->user;
                if ($key == 0) {
                    $userMailTo = $user->email;
                } else {
                    array_push($userMailCc, $user->email);
                }
            }
            Mail::to($userMailTo)->cc($userMailCc)->queue(new NotifyShipped($content));
        }

        if ($sendToAdvisor) {
            # advisor notify
            $roomAdvisors = $room->roomAdvisors;
            $advisorMailCc = [];
            $advisorMailTo = '';
            foreach ($roomAdvisors as $key => $roomAdvisor) {
                $advisor = $roomAdvisor->user;
                if ($key == 0) {
                    $advisorMailTo = $advisor->email;
                } else {
                    array_push($advisorMailCc, $advisor->email);
                }
            }

            Mail::to($advisorMailTo)->cc($advisorMailCc)->queue(new NotifyShipped($content));

        }

        Flash::success('Send content to room ' . $room->name . ' successfully.');

        return redirect(route('rooms.index'));
    }

    public function groupByOrder($year)
    {
        // get ห้องที่ยังไม่ได้จัด
        $rooms = $this->getRoomsUnJoinByYear($year);
        // get นร.ที่ยังไม่โดนจัดเข้าห้อง
        $users = $this->getStudentUnJoinByYear($year);

        // Nroom / Nstu = stu per room (type int)
        // for Nroom  | add stu

        $splited = $users->split(count($rooms));

        foreach ($rooms as $key => $room) {
            $index = (int) $key - 1;
            foreach ($splited[$index] as $user) {
                $this->roomUserRepository->create([
                    'user_id' => $user->id,
                    'room_id' => $room->id,
                ]);
            }
        }
        return redirect()->route('rooms.index');
    }

    public function groupByRandom($year)
    {
        // get ห้องที่ยังไม่ได้จัด
        $rooms = $this->getRoomsUnJoinByYear($year);
        // get นร.ที่ยังไม่โดนจัดเข้าห้อง
        $users = $this->getStudentUnJoinByYear($year);

        // $usersPerRoom = count($users) / count($rooms);
        // $usersPerRoom = (int) floor($usersPerRoom);

        // $over = count($users) % count($rooms);

        // Nroom / Nstu = stu per room (type int)
        // for Nroom  | add stu
        $users = $users->shuffle();
        $users = $users->shuffle();

        $splited = $users->split(count($rooms));

        foreach ($rooms as $key => $room) {
            // dd($key, $splited);
            $index = (int) $key;
            foreach ($splited[$index] as $user) {
                $this->roomUserRepository->create([
                    'user_id' => $user->id,
                    'room_id' => $room->id,
                ]);
            }
        }
        return redirect()->route('rooms.index');
    }

    public function randomPresentOrder($roomId, Request $request)
    {
        $year = $request->input('year');
        $userInRoom = $this->roomUserRepository->findWhere(['room_id' => $roomId]);
        if (count($userInRoom) < 1) {
            Flash::error('Cannot Random Present Number because room is empty.');

            return redirect(route('rooms.index'));
        }
        $userInRoom = $userInRoom->toArray();
        $presents = $this->presentRepository->findWhere(['room_id' => $roomId]);
        foreach ($presents as $key => $present) {
            $userFirst = $userInRoom[0];
            // remove with index
            array_splice($userInRoom, 0, 1);
            array_push($userInRoom, $userFirst);

            foreach ($userInRoom as $key => $item) {
                $this->userPresentRepository->create([
                    'present_id' => $present->id,
                    'user_id' => $item['user_id'],
                    'room_id' => $item['room_id'],
                    'no' => $key + 1,
                ]);
            }

        }

        Flash::success('Random Present Number Successfully.');
        if ($year != '') {
            return redirect(route('rooms.index', ['year' => $year]));
        }

        return redirect(route('rooms.index'));
    }

    public function randomPresentNumber($roomId, Request $request)
    {
        $year = $request->input('year');
        $userInRoom = $this->roomUserRepository->findWhere(['room_id' => $roomId]);
        if (count($userInRoom) < 1) {
            Flash::error('Cannot Random Present Number because room is empty.');

            return redirect(route('rooms.index'));
        }

        $presents = $this->presentRepository->findWhere(['room_id' => $roomId]);
        foreach ($presents as $present) {
            $userInRoom = $userInRoom->shuffle();
            $userInRoom = $userInRoom->shuffle();

            foreach ($userInRoom as $key => $item) {
                $this->userPresentRepository->create([
                    'present_id' => $present->id,
                    'user_id' => $item->user_id,
                    'room_id' => $item->room_id,
                    'no' => $key + 1,
                ]);
            }

        }

        Flash::success('Random Present Number Successfully.');
        if ($year != '') {
            return redirect(route('rooms.index', ['year' => $year]));
        }

        return redirect(route('rooms.index'));
    }

    private function getStudentUnJoinByYear($year)
    {
        $rooms = $this->roomRepository->findWhere([
            'year' => $year,
        ])->toArray();

        $array_room_ids = [];
        foreach ($rooms as $r) {
            array_push($array_room_ids, $r['id']);
        }

        // room_user where room id select user_id
        $userRooms = $this->roomUserRepository->findWhereIn('room_id', $array_room_ids)->toArray();
        $array_user_ids = [];
        foreach ($userRooms as $userRoom) {
            array_push($array_user_ids, $userRoom['user_id']);
        }

        //  dd($array_user_ids);
        $users = $this->userRepository->findWhere([
            'year' => $year,
            // where without user_id join
        ])->whereNotIn('id', $array_user_ids)->sortBy('id');

        return $users;
    }

    private function getRoomsUnJoinByYear($year)
    {
        $rooms = $this->roomRepository->findWhere([
            'year' => $year,
        ]);

        $array_room_ids = [];
        foreach ($rooms as $r) {
            array_push($array_room_ids, $r->id);
        }

        // room_user where room id select user_id
        $userRooms = $this->roomUserRepository->findWhereIn('room_id', $array_room_ids)->toArray();
        $array_room_join_id = [];
        foreach ($userRooms as $userRoom) {
            array_push($array_room_join_id, $userRoom['room_id']);
        }

        $array_room_joined_id = [];
        foreach ($array_room_ids as $roomid) {
            if (in_array($roomid, $array_room_join_id)) {
                array_push($array_room_joined_id, $roomid);
            }
        }

        return $rooms->whereNotIn('id', $array_room_joined_id);
    }

    /**
     * Show the form for creating a new Room.
     *
     * @return Response
     */
    public function manual($room_id)
    {
        $room = $this->roomRepository->findWithoutFail($room_id);

        if (empty($room)) {
            Flash::error('Room not found');

            return redirect(route('rooms.index'));
        }

        // get year
        $year = $room->year;

        $users = $this->getStudentUnJoinByYear($year);

        $userRooms = $room->roomUsers;

        // dd($userRooms);

        return view('rooms.manual')
            ->with('users', $users)
            ->with('userRooms', $userRooms)
            ->with('room', $room);
    }

    /**
     * Show the form for creating a new Room.
     *
     * @return Response
     */
    public function detroyUser($roomId, $userId, Request $request)
    {
        $room = $this->roomRepository->findWithoutFail($roomId);
        if (empty($room)) {
            Flash::error('Room not found');

            return redirect(route('rooms.index'));
        }

        $roomUser = $this->roomUserRepository->findWhere(['room_id' => $roomId, 'user_id' => $userId])->first();
        $this->roomUserRepository->delete($roomUser->id);
        //rooms.manual
        return redirect()->route('rooms.manual', [$roomId]);
    }

    /**
     * Show the form for creating a new Room.
     *
     * @return Response
     */
    public function saveManual($room_id, Request $request)
    {
        $ids = $request->input('user_ids');

        foreach ($ids as $id) {
            $this->roomUserRepository->create([
                'user_id' => $id,
                'room_id' => $room_id,
            ]);
        }
        return redirect()->route('roomUsers.index');
    }

    /**
     * Display a listing of the Room.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->roomRepository->pushCriteria(new RequestCriteria($request));

        $filter_year = $request->input('year');

        if (!empty($filter_year)) {
            $rooms = $this->roomRepository->with(['roomUsers', 'userPresent'])->findWhere(['year' => $filter_year]);
        } else {
            $rooms = $this->roomRepository->with(['roomUsers', 'userPresent'])->all();
        }

        $Year = Carbon::now()->format('Y');
        $Year = (int) $Year - 2;
        $years = ['' => ''];
        for ($i = $Year; $i < $Year + 10; $i++) {
            $years['' . $i] = $i;
        }
        // dd($rooms);
        return view('rooms.index')
            ->with('rooms', $rooms)
            ->with('years', $years)
            ->with('filter_year', $filter_year);
    }

    /**
     * Show the form for creating a new Room.
     *
     * @return Response
     */
    public function create()
    {
        $Year = Carbon::now()->format('Y');
        $Year = (int) $Year;
        $years = ['' => ''];
        for ($i = $Year; $i < $Year + 10; $i++) {
            $years['' . $i] = $i;
        }

        return view('rooms.create')->with(['years' => $years]);
    }

    /**
     * Store a newly created Room in storage.
     *
     * @param CreateRoomRequest $request
     *
     * @return Response
     */
    public function store(CreateRoomRequest $request)
    {
        $input = $request->all();

        $room = $this->roomRepository->create($input);

        Flash::success('Room saved successfully.');

        return redirect(route('rooms.index'));
    }

    /**
     * Display the specified Room.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $room = $this->roomRepository->with(['roomUsers'])->findWithoutFail($id);

        if (empty($room)) {
            Flash::error('Room not found');

            return redirect(route('rooms.index'));
        }

        //  $advisers = $this->userRoleRepository->with('user')->findWhere(['role_id' => '2']);

        return view('rooms.show')->with('room', $room);
    }

    /**
     * Show the form for editing the specified Room.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $Year = Carbon::now()->format('Y');
        $Year = (int) $Year;
        $years = ['' => ''];
        for ($i = $Year; $i < $Year + 10; $i++) {
            $years['' . $i] = $i;
        }

        $room = $this->roomRepository->findWithoutFail($id);

        if (empty($room)) {
            Flash::error('Room not found');

            return redirect(route('rooms.index'));
        }

        return view('rooms.edit')->with('room', $room)->with(['years' => $years]);
    }

    /**
     * Update the specified Room in storage.
     *
     * @param  int              $id
     * @param UpdateRoomRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoomRequest $request)
    {
        $room = $this->roomRepository->findWithoutFail($id);

        if (empty($room)) {
            Flash::error('Room not found');

            return redirect(route('rooms.index'));
        }

        $room = $this->roomRepository->update($request->all(), $id);

        Flash::success('Room updated successfully.');

        return redirect(route('rooms.index'));
    }

    /**
     * Remove the specified Room from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $room = $this->roomRepository->findWithoutFail($id);

        if (empty($room)) {
            Flash::error('Room not found');

            return redirect(route('rooms.index'));
        }

        $this->roomRepository->delete($id);

        Flash::success('Room deleted successfully.');

        return redirect(route('rooms.index'));
    }
}
