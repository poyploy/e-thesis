<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Repositories\MenuRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PermissionController extends AppBaseController
{
    /** @var  PermissionRepository */
    private $permissionRepository;

    /** @var  RoleRepository */
    private $roleRepository;

    /** @var MenuRepository */
    private $menuRepository;

    public function __construct(PermissionRepository $permissionRepo, RoleRepository $roleRepo, MenuRepository $menuRepo)
    {
        $this->permissionRepository = $permissionRepo;
        $this->roleRepository = $roleRepo;
        $this->menuRepository = $menuRepo;
    }

    /**
     * Display a listing of the Permission.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->permissionRepository->pushCriteria(new RequestCriteria($request));
        $permissions = $this->permissionRepository->all();

        return view('permissions.index')
            ->with('permissions', $permissions);
    }

    /**
     * Show the form for creating a new Permission.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        // Get Roles
        $this->roleRepository->pushCriteria(new RequestCriteria($request));
        $roles = $this->roleRepository->all();
        $roles = $roles->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
        $roles = array_merge([0 => 'Select options'], $roles->toArray());
        // Get Menus
        $this->menuRepository->pushCriteria(new RequestCriteria($request));
        $menus = $this->menuRepository->all();
        $menus = $menus->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
        $menus = array_merge([0=> 'Select options'], $menus->toArray());

        return view('permissions.create')->with(['roles' => $roles, 'menus' => $menus]);
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param CreatePermissionRequest $request
     *
     * @return Response
     */
    public function store(CreatePermissionRequest $request)
    {
        $input = $request->all();

        $permission = $this->permissionRepository->create($input);

        Flash::success('Permission saved successfully.');

        return redirect(route('permissions.index'));
    }

    /**
     * Display the specified Permission.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $permission = $this->permissionRepository->findWithoutFail($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('permissions.index'));
        }

        return view('permissions.show')->with('permission', $permission);
    }

    /**
     * Show the form for editing the specified Permission.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $permission = $this->permissionRepository->findWithoutFail($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('permissions.index'));
        }

        $roles = $this->roleRepository->all();
        $roles = $roles->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
        // dd($roles->toArray());
        
        $roles = array_merge([0 => 'Select options'], $roles->toArray());
        // dd($roles);

        $menus = $this->menuRepository->all();
        $menus = $menus->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
        $menus = array_merge([0=> 'Select options'], $menus->toArray());

        return view('permissions.edit')->with('permission', $permission)
        ->with('roles', $roles)->with('menus', $menus);
    }

    /**
     * Update the specified Permission in storage.
     *
     * @param  int              $id
     * @param UpdatePermissionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePermissionRequest $request)
    {
        $permission = $this->permissionRepository->findWithoutFail($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('permissions.index'));
        }

        $permission = $this->permissionRepository->update($request->all(), $id);

        Flash::success('Permission updated successfully.');

        return redirect(route('permissions.index'));
    }

    /**
     * Remove the specified Permission from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $permission = $this->permissionRepository->findWithoutFail($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('permissions.index'));
        }

        $this->permissionRepository->delete($id);

        Flash::success('Permission deleted successfully.');

        return redirect(route('permissions.index'));
    }
}
