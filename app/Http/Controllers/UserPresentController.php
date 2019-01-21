<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateUserPresentRequest;
use App\Http\Requests\UpdateUserPresentRequest;
use App\Repositories\UserAdvisorRepository;
use App\Repositories\UserPresentRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserPresentController extends AppBaseController
{
    /** @var  UserPresentRepository */
    private $userPresentRepository;

    /** @var  UserAdvisorRepository */
    private $userAdvisorRepository;

    public function __construct(UserAdvisorRepository $userAdvisorRepo, UserPresentRepository $userPresentRepo)
    {
        $this->userPresentRepository = $userPresentRepo;
        $this->userAdvisorRepository = $userAdvisorRepo;
    }

    /**
     * Display a listing of the UserPresent.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $auth = Auth::user();
        $this->userPresentRepository->pushCriteria(new RequestCriteria($request));
        $roleName = $auth->usersRoles->first()->role->name;
        if ($roleName == "STUDENT") {
            $userPresents = $this->userPresentRepository->with('present')->findWhere(['user_id' => $auth->id]);
        //    dd($userPresents);
            return view('user_presents.index')
                ->with('userPresents', $userPresents);
        } else {
            return redirect()->route('index');
        }
    }

    /**
     * Show the form for creating a new UserPresent.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_presents.create');
    }

    /**
     * Store a newly created UserPresent in storage.
     *
     * @param CreateUserPresentRequest $request
     *
     * @return Response
     */
    public function store(CreateUserPresentRequest $request)
    {
        $input = $request->all();

        $userPresent = $this->userPresentRepository->create($input);

        Flash::success('User Present saved successfully.');

        return redirect(route('userPresents.index'));
    }

    /**
     * Display the specified UserPresent.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userPresents = $this->userPresentRepository->findWhere(['present_id' => $id])->SortBy('no');

        if (empty($userPresents)) {
            Flash::error('User Present not found');

            return redirect(route('userPresents.index'));
        }

        return view('user_presents.show')->with('userPresents', $userPresents);
    }

    /**
     * Show the form for editing the specified UserPresent.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userPresent = $this->userPresentRepository->findWithoutFail($id);

        if (empty($userPresent)) {
            Flash::error('User Present not found');

            return redirect(route('userPresents.index'));
        }

        return view('user_presents.edit')->with('userPresent', $userPresent);
    }

    /**
     * Update the specified UserPresent in storage.
     *
     * @param  int              $id
     * @param UpdateUserPresentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserPresentRequest $request)
    {
        $userPresent = $this->userPresentRepository->findWithoutFail($id);

        if (empty($userPresent)) {
            Flash::error('User Present not found');

            return redirect(route('userPresents.index'));
        }

        $userPresent = $this->userPresentRepository->update($request->all(), $id);

        Flash::success('User Present updated successfully.');

        return redirect(route('userPresents.index'));
    }

    /**
     * Remove the specified UserPresent from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userPresent = $this->userPresentRepository->findWithoutFail($id);

        if (empty($userPresent)) {
            Flash::error('User Present not found');

            return redirect(route('userPresents.index'));
        }

        $this->userPresentRepository->delete($id);

        Flash::success('User Present deleted successfully.');

        return redirect(route('userPresents.index'));
    }
}
