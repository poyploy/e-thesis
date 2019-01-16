<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Repositories\RoomRepository;
use App\Repositories\RoomUserRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class RoomController extends AppBaseController
{
    /** @var  RoomRepository */
    private $roomRepository;

    /** @var  UserRepository */
    private $userRepository;

    /** @var  RoomUserRepository */
    private $roomUserRepository;

    public function __construct(RoomRepository $roomRepo, UserRepository $userRepo, RoomUserRepository $roomUserRepo)
    {
        $this->roomRepository = $roomRepo;
        $this->userRepository = $userRepo;
        $this->roomUserRepository = $roomUserRepo;
    }

    public function groupByOrder($year){
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

        return view('rooms.manual')->with('users', $users)->with('room', $room);
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
            $rooms = $this->roomRepository->with(['roomUsers'])->findWhere(['year' => $filter_year]);
        } else {
            $rooms = $this->roomRepository->with(['roomUsers'])->all();
        }

        $Year = Carbon::now()->format('Y');
        $Year = (int) $Year-2;
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
