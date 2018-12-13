<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRoleRequest;
use App\Http\Requests\UpdateUserRoleRequest;
use App\Repositories\UserRoleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserRoleController extends AppBaseController
{
    /** @var  UserRoleRepository */
    private $userRoleRepository;

    public function __construct(UserRoleRepository $userRoleRepo)
    {
        $this->userRoleRepository = $userRoleRepo;
    }

    /**
     * Display a listing of the UserRole.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userRoleRepository->pushCriteria(new RequestCriteria($request));
        $userRoles = $this->userRoleRepository->all();

        return view('user_roles.index')
            ->with('userRoles', $userRoles);
    }

    /**
     * Show the form for creating a new UserRole.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_roles.create');
    }

    /**
     * Store a newly created UserRole in storage.
     *
     * @param CreateUserRoleRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRoleRequest $request)
    {
        $input = $request->all();

        $userRole = $this->userRoleRepository->create($input);

        Flash::success('User Role saved successfully.');

        return redirect(route('userRoles.index'));
    }

    /**
     * Display the specified UserRole.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userRole = $this->userRoleRepository->findWithoutFail($id);

        if (empty($userRole)) {
            Flash::error('User Role not found');

            return redirect(route('userRoles.index'));
        }

        return view('user_roles.show')->with('userRole', $userRole);
    }

    /**
     * Show the form for editing the specified UserRole.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userRole = $this->userRoleRepository->findWithoutFail($id);

        if (empty($userRole)) {
            Flash::error('User Role not found');

            return redirect(route('userRoles.index'));
        }

        return view('user_roles.edit')->with('userRole', $userRole);
    }

    /**
     * Update the specified UserRole in storage.
     *
     * @param  int              $id
     * @param UpdateUserRoleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRoleRequest $request)
    {
        $userRole = $this->userRoleRepository->findWithoutFail($id);

        if (empty($userRole)) {
            Flash::error('User Role not found');

            return redirect(route('userRoles.index'));
        }

        $userRole = $this->userRoleRepository->update($request->all(), $id);

        Flash::success('User Role updated successfully.');

        return redirect(route('userRoles.index'));
    }

    /**
     * Remove the specified UserRole from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userRole = $this->userRoleRepository->findWithoutFail($id);

        if (empty($userRole)) {
            Flash::error('User Role not found');

            return redirect(route('userRoles.index'));
        }

        $this->userRoleRepository->delete($id);

        Flash::success('User Role deleted successfully.');

        return redirect(route('userRoles.index'));
    }
}
