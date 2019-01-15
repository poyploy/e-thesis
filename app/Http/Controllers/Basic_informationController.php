<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UpdateBasic_informationRequest;
use App\Models\Basic_information as BasicInformation;
use App\Repositories\Basic_informationRepository;
use App\Repositories\RoleRepository;
use App\Repositories\SettingRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserRoleRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class Basic_informationController extends AppBaseController
{

    /** @var  UsersRepository */
    private $usersRepository;

    /** @var  SettingRepository */
    private $settingRepository;

    /** @var  Basic_informationRepository */
    private $basicInformationRepository;

    /** @var  UserRoleRepository */
    private $userRoleRepository;

    private $roleRepository;

    public function __construct(UserRoleRepository $userRoleRepo, Basic_informationRepository $basicInformationRepo, UserRepository $userRepo, RoleRepository $roleRepo, SettingRepository $settingRepo)
    {
        $this->settingRepository = $settingRepo;
        $this->basicInformationRepository = $basicInformationRepo;
        $this->usersRepository = $userRepo;
        $this->userRoleRepository = $userRoleRepo;
        $this->roleRepository = $roleRepo;
    }

    /**
     * Display a listing of the Basic_information.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->basicInformationRepository->pushCriteria(new RequestCriteria($request));
        $basicInformations = $this->basicInformationRepository->all();

        return redirect()->route('basicInformations.show');
    }

    /**
     * Display the specified Basic_information.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show()
    {
        $auth = Auth::user();
        $basicInformation = $this->basicInformationRepository->findWhere(['user_id' => $auth->id])->first();
        if (empty($basicInformation)) {
            $basicInformation = new BasicInformation();
        }

        $roleId = Auth::user()->usersRoles()->first()->role_id;
        $role = $this->roleRepository->findWithoutFail($roleId);
        // Get Option with Setting table
        $add_adviser = $this->settingRepository->findWhere(['option' => 'ADD_ADVISER'])->first();
        // Get Advisor with UserRole table
        $advisers = $this->userRoleRepository->with('user')->findWhere(['role_id' => '2']);
        $advisers = $advisers->mapWithKeys(function ($item) {
            $name = $item->user->name;
            $id = $item->user->id;
            return [$id => $name];
        });

        return view('basic_informations.show')
            ->with('basicInformation', $basicInformation)
            ->with('user', $auth)
            ->with('role', $role)
            ->with('advisers', $advisers)
            ->with('add_adviser', $add_adviser);
    }

    /**
     * Update the specified Basic_information in storage.
     *
     * @param  int              $id
     * @param UpdateBasic_informationRequest $request
     *
     * @return Response
     */
    public function update(UpdateBasic_informationRequest $request)
    {
        // Get session user logined
        $auth = Auth::user();
        // Get BasicInfo by user_id
        $basicInformation = $this->basicInformationRepository->findWhere(['user_id' => $auth->id])->first();
        if (empty($basicInformation)) {
            // Create case
            $basicInformation = $this->basicInformationRepository->create($request->all());
        } else {
            // Update case 
            $basicInformation = $this->basicInformationRepository->update($request->all(), $basicInformation->id);
        }

        // Get default data with User table
        $user = $this->usersRepository->findWithoutFail($auth->id);
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');

        $user = $user->toArray();
        // Update new data to User table
        $this->usersRepository->update($user, $auth->id);
        // Set alert
        Flash::success('Basic Information updated successfully.');

        return redirect(route('basicInformations.show'));
    }

    public function updateAdviser(Request $request)
    {
        $auth = Auth::user();
        $basicInformation = $this->basicInformationRepository->findWhere(['user_id' => $auth->id])->first();

        $this->basicInformationRepository->update($request->all(), $basicInformation->id);

        Flash::success('Basic Information updated successfully.');

        return redirect(route('basicInformations.show'));

    }

}
