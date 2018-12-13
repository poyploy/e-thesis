<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoomUserRequest;
use App\Http\Requests\UpdateRoomUserRequest;
use App\Repositories\RoomUserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class RoomUserController extends AppBaseController
{
    /** @var  RoomUserRepository */
    private $roomUserRepository;

    public function __construct(RoomUserRepository $roomUserRepo)
    {
        $this->roomUserRepository = $roomUserRepo;
    }

    /**
     * Display a listing of the RoomUser.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->roomUserRepository->pushCriteria(new RequestCriteria($request));
        $roomUsers = $this->roomUserRepository->all();

        return view('room_users.index')
            ->with('roomUsers', $roomUsers);
    }

    /**
     * Show the form for creating a new RoomUser.
     *
     * @return Response
     */
    public function create()
    {
        return view('room_users.create');
    }

    /**
     * Store a newly created RoomUser in storage.
     *
     * @param CreateRoomUserRequest $request
     *
     * @return Response
     */
    public function store(CreateRoomUserRequest $request)
    {
        $input = $request->all();

        $roomUser = $this->roomUserRepository->create($input);

        Flash::success('Room User saved successfully.');

        return redirect(route('roomUsers.index'));
    }

    /**
     * Display the specified RoomUser.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $roomUser = $this->roomUserRepository->findWithoutFail($id);

        if (empty($roomUser)) {
            Flash::error('Room User not found');

            return redirect(route('roomUsers.index'));
        }

        return view('room_users.show')->with('roomUser', $roomUser);
    }

    /**
     * Show the form for editing the specified RoomUser.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $roomUser = $this->roomUserRepository->findWithoutFail($id);

        if (empty($roomUser)) {
            Flash::error('Room User not found');

            return redirect(route('roomUsers.index'));
        }

        return view('room_users.edit')->with('roomUser', $roomUser);
    }

    /**
     * Update the specified RoomUser in storage.
     *
     * @param  int              $id
     * @param UpdateRoomUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoomUserRequest $request)
    {
        $roomUser = $this->roomUserRepository->findWithoutFail($id);

        if (empty($roomUser)) {
            Flash::error('Room User not found');

            return redirect(route('roomUsers.index'));
        }

        $roomUser = $this->roomUserRepository->update($request->all(), $id);

        Flash::success('Room User updated successfully.');

        return redirect(route('roomUsers.index'));
    }

    /**
     * Remove the specified RoomUser from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $roomUser = $this->roomUserRepository->findWithoutFail($id);

        if (empty($roomUser)) {
            Flash::error('Room User not found');

            return redirect(route('roomUsers.index'));
        }

        $this->roomUserRepository->delete($id);

        Flash::success('Room User deleted successfully.');

        return redirect(route('roomUsers.index'));
    }
}
