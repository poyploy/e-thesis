<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateAdvisorUserPresentRequest;
use App\Http\Requests\UpdateAdvisorUserPresentRequest;
use App\Repositories\AdvisorsApproveRepository;
use App\Repositories\AdvisorUserPresentRepository;
use App\Repositories\AssessmentRepository;
use App\Repositories\PresentRepository;
use App\Repositories\SettingRepository;
use App\Repositories\UserAdvisorRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AdvisorUserPresentController extends AppBaseController
{
    /** @var  AssessmentRepository */
    private $assessmentRepository;

    /** @var  SettingRepository */
    private $settingRepository;

    /** @var  AdvisorsApproveRepository */
    private $advisorsApproveRepository;

    /** @var  PresentRepository */
    private $presentRepository;

    /** @var  AdvisorUserPresentRepository */
    private $advisorUserPresentRepository;

    /** @var  UserAdvisorRepository */
    private $userAdvisorRepository;

    public function __construct(AssessmentRepository $assessmentRepo,SettingRepository $settingRepo, AdvisorsApproveRepository $advisorsApproveRepo, PresentRepository $presentRepo, AdvisorUserPresentRepository $advisorUserPresentRepo, UserAdvisorRepository $userAdvisorRepo)
    {

        $this->advisorsApproveRepository = $advisorsApproveRepo;
        $this->presentRepository = $presentRepo;
        $this->settingRepository = $settingRepo;
        $this->advisorUserPresentRepository = $advisorUserPresentRepo;
        $this->userAdvisorRepository = $userAdvisorRepo;
        $this->assessmentRepository = $assessmentRepo;
    }

    /**
     * Display the specified UserPresent.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function showDetail($id, $roomId)
    {
        $userPresents = $this->advisorUserPresentRepository->findWhere(['present_id' => $id])->SortBy('no');
        if (empty($userPresents)) {
            Flash::error('User Present not found');

            return redirect(route('userPresents.index'));
        }

        $auth = Auth::user();
        $setting = $this->settingRepository->findWhere(['option' => 'ADVISOR_APPROVE_MIN'])->first();
        $value = (int) $setting->value;
        foreach ($userPresents as $userPresent) {
            $approved = $this->advisorsApproveRepository->findWhere(['student_id' => $userPresent->user_id, 'present_id' => $id])->count();
            if ($approved >= $value) {
                $userPresent->assessment = true;
            } else {
                $userPresent->assessment = false;
            }

            $assessmented = $this->assessmentRepository->findWhere([
                'user_id' =>  $userPresent->user_id,
                'present_id' =>  $id,
                'teacher_id' => $auth->id,
            ])->count();
            if ($assessmented >0) {
                $userPresent->assessmented = true;
            } else {
                $userPresent->assessmented = false;
            }
        }

        return view('advisor_user_presents.show_detail')
            ->with('userPresents', $userPresents)
            ->with('roomId', $roomId);
    }

    /**
     * Display a listing of the AdvisorUserPresent.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $auth = Auth::user();
        $roomAds = $this->userAdvisorRepository->findWhere(['user_id' => $auth->id])->SortByDesc('room_id');

        $this->advisorUserPresentRepository->pushCriteria(new RequestCriteria($request));
        $advisorUserPresents = $this->advisorUserPresentRepository->all();

        return view('advisor_user_presents.index')
            ->with('roomAds', $roomAds);
        // ->with('advisorUserPresents', $advisorUserPresents);
    }

    /**
     * Show the form for creating a new AdvisorUserPresent.
     *
     * @return Response
     */
    public function create()
    {
        return view('advisor_user_presents.create');
    }

    /**
     * Store a newly created AdvisorUserPresent in storage.
     *
     * @param CreateAdvisorUserPresentRequest $request
     *
     * @return Response
     */
    public function store(CreateAdvisorUserPresentRequest $request)
    {
        $input = $request->all();

        $advisorUserPresent = $this->advisorUserPresentRepository->create($input);

        Flash::success('Advisor User Present saved successfully.');

        return redirect(route('advisorUserPresents.index'));
    }

    /**
     * Display the specified AdvisorUserPresent.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($roomId)
    {
        $presents = $this->presentRepository->findWhere(['room_id' => $roomId]);
        // $advisorUserPresent = $this->advisorUserPresentRepository->findWhere(['room_id'=>$roomId])->groupBy('present_id');

        if (empty($presents)) {
            Flash::error('Advisor User Present not found');

            return redirect(route('advisorUserPresents.index'));
        }

        // dd($presents);

        return view('advisor_user_presents.show')->with('presents', $presents);
    }

    /**
     * Show the form for editing the specified AdvisorUserPresent.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $advisorUserPresent = $this->advisorUserPresentRepository->findWithoutFail($id);

        if (empty($advisorUserPresent)) {
            Flash::error('Advisor User Present not found');

            return redirect(route('advisorUserPresents.index'));
        }

        return view('advisor_user_presents.edit')->with('advisorUserPresent', $advisorUserPresent);
    }

    /**
     * Update the specified AdvisorUserPresent in storage.
     *
     * @param  int              $id
     * @param UpdateAdvisorUserPresentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdvisorUserPresentRequest $request)
    {
        $advisorUserPresent = $this->advisorUserPresentRepository->findWithoutFail($id);

        if (empty($advisorUserPresent)) {
            Flash::error('Advisor User Present not found');

            return redirect(route('advisorUserPresents.index'));
        }

        $advisorUserPresent = $this->advisorUserPresentRepository->update($request->all(), $id);

        Flash::success('Advisor User Present updated successfully.');

        return redirect(route('advisorUserPresents.index'));
    }

    /**
     * Remove the specified AdvisorUserPresent from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $advisorUserPresent = $this->advisorUserPresentRepository->findWithoutFail($id);

        if (empty($advisorUserPresent)) {
            Flash::error('Advisor User Present not found');

            return redirect(route('advisorUserPresents.index'));
        }

        $this->advisorUserPresentRepository->delete($id);

        Flash::success('Advisor User Present deleted successfully.');

        return redirect(route('advisorUserPresents.index'));
    }
}
