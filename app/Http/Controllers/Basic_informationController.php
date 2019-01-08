<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UpdateBasic_informationRequest;
use App\Models\Basic_information as BasicInformation;
use App\Repositories\Basic_informationRepository;
use App\Repositories\UserRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class Basic_informationController extends AppBaseController
{

    /** @var  UsersRepository */
    private $usersRepository;

    /** @var  Basic_informationRepository */
    private $basicInformationRepository;

    public function __construct(Basic_informationRepository $basicInformationRepo, UserRepository $userRepo)
    {
        $this->basicInformationRepository = $basicInformationRepo;
        $this->usersRepository = $userRepo;
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
    
        return view('basic_informations.show')->with('basicInformation', $basicInformation)->with('user', $auth);
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
        $auth = Auth::user();
        $basicInformation = $this->basicInformationRepository->findWhere(['user_id' => $auth->id])->first();
        if (empty($basicInformation)) {
            $basicInformation = $this->basicInformationRepository->create($request->all());
        } else {
            $basicInformation = $this->basicInformationRepository->update($request->all(), $basicInformation->id);
        }
        $user = $this->usersRepository->findWithoutFail($auth->id);
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');

        $user = $user->toArray();

        $this->usersRepository->update($user, $auth->id);

        Flash::success('Basic Information updated successfully.');

        return redirect(route('basicInformations.show'));
    }

}
