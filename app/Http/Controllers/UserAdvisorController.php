<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateUserAdvisorRequest;
use App\Http\Requests\UpdateUserAdvisorRequest;
use App\Repositories\RoomRepository;
use App\Repositories\UserAdvisorRepository;
use App\Repositories\UserRoleRepository;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserAdvisorController extends AppBaseController
{

    /** @var  RoomRepository */
    private $roomRepository;

    /** @var  UserRoleRepository */
    private $userRoleRepository;

    /** @var  UserAdvisorRepository */
    private $userAdvisorRepository;

    public function __construct(UserRoleRepository $userRoleRepo, RoomRepository $roomRepo, UserAdvisorRepository $userAdvisorRepo)
    {
        $this->userRoleRepository = $userRoleRepo;
        $this->roomRepository = $roomRepo;
        $this->userAdvisorRepository = $userAdvisorRepo;
    }

    /**
     * Display a listing of the UserAdvisor.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userAdvisorRepository->pushCriteria(new RequestCriteria($request));
        $userAdvisors = $this->userAdvisorRepository->all();

        return view('user_advisors.index')
            ->with('userAdvisors', $userAdvisors);
    }

    /**
     * Display a listing of the UserAdvisor.
     *
     * @param Request $request
     * @return Response
     */
    public function main($id, Request $request)
    {
        $room = $this->roomRepository->findWithoutFail($id);
        if (!empty($room)) {
            $request->session()->put("room", $room);
        }

        $this->userAdvisorRepository->pushCriteria(new RequestCriteria($request));
        $userAdvisors = $this->userAdvisorRepository->findWhere(['room_id' => $room->id]);

        return view('user_advisors.index')
            ->with('userAdvisors', $userAdvisors)
            ->with('room', $room);
    }

    /**
     * Show the form for creating a new UserAdvisor.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $room = [];
        if ($request->session()->has('room')) {
            $room = $request->session()->get('room');

        } else {
            return redirect()->route('rooms.index');
        }

        $advisors = $this->userRoleRepository->with('user')->findWhere(['role_id' => '2']);
        $advisors = $advisors->mapWithKeys(function ($item) {
            $name = $item->user->name;
            $id = $item->user->id;
            return [$id => $name];
        });

        return view('user_advisors.create')->with('room', $room)->with('advisors', $advisors);
    }

    /**
     * Store a newly created UserAdvisor in storage.
     *
     * @param CreateUserAdvisorRequest $request
     *
     * @return Response
     */
    public function store(CreateUserAdvisorRequest $request)
    {
        $input = $request->all();

        $userAdvisor = $this->userAdvisorRepository->create($input);

        Flash::success('User Advisor saved successfully.');

        $room = [];
        if ($request->session()->has('room')) {
            $room = $request->session()->get('room');

        } else {
            return redirect()->route('rooms.index');
        }

        return redirect(route('userAdvisors.main', ['id' => $room->id]));
    }

    /**
     * Display the specified UserAdvisor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userAdvisor = $this->userAdvisorRepository->findWithoutFail($id);

        if (empty($userAdvisor)) {
            Flash::error('User Advisor not found');

            return redirect(route('userAdvisors.index'));
        }

        return view('user_advisors.show')->with('userAdvisor', $userAdvisor);
    }

    /**
     * Show the form for editing the specified UserAdvisor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id, Request $request)
    {
        $userAdvisor = $this->userAdvisorRepository->findWithoutFail($id);

        if (empty($userAdvisor)) {
            Flash::error('User Advisor not found');

            return redirect(route('userAdvisors.index'));
        }

        $room = [];
        if ($request->session()->has('room')) {
            $room = $request->session()->get('room');

        } else {
            return redirect()->route('rooms.index');
        }

        $advisors = $this->userRoleRepository->with('user')->findWhere(['role_id' => '2']);
        $advisors = $advisors->mapWithKeys(function ($item) {
            $name = $item->user->name;
            $id = $item->user->id;
            return [$id => $name];
        });

        return view('user_advisors.edit')->with('room', $room)
            ->with('userAdvisor', $userAdvisor)
            ->with('advisors', $advisors);
    }

    /**
     * Update the specified UserAdvisor in storage.
     *
     * @param  int              $id
     * @param UpdateUserAdvisorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserAdvisorRequest $request)
    {
        $userAdvisor = $this->userAdvisorRepository->findWithoutFail($id);

        if (empty($userAdvisor)) {
            Flash::error('User Advisor not found');

            return redirect(route('userAdvisors.index'));
        }

        $room = [];
        if ($request->session()->has('room')) {
            $room = $request->session()->get('room');

        } else {
            return redirect()->route('rooms.index');
        }

        $userAdvisor = $this->userAdvisorRepository->update($request->all(), $id);

        Flash::success('User Advisor updated successfully.');

        return redirect(route('userAdvisors.main', ['id' => $room->id]));
    }

    /**
     * Remove the specified UserAdvisor from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userAdvisor = $this->userAdvisorRepository->findWithoutFail($id);

        if (empty($userAdvisor)) {
            Flash::error('User Advisor not found');

            return redirect(route('userAdvisors.index'));
        }

        $this->userAdvisorRepository->delete($id);

        Flash::success('User Advisor deleted successfully.');

        return redirect(route('userAdvisors.index'));
    }
}
