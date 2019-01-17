<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateAdvisorsApproveRequest;
use App\Http\Requests\UpdateAdvisorsApproveRequest;
use App\Repositories\AdvisorsApproveRepository;
use App\Repositories\Basic_informationRepository;
use App\Repositories\PresentRepository;
use App\Repositories\UserAdvisorRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AdvisorsApproveController extends AppBaseController
{
    /** @var  AdvisorsApproveRepository */
    private $advisorsApproveRepository;

    /** @var  PresentRepository */
    private $presentRepository;

    /** @var  Basic_informationRepository */
    private $basicInformationRepository;

    /** @var  UserAdvisorRepository */
    private $userAdvisorRepository;

    public function __construct(UserAdvisorRepository $userAdvisorRepo, PresentRepository $presentRepo, Basic_informationRepository $basicRepo, AdvisorsApproveRepository $advisorsApproveRepo)
    {
        $this->advisorsApproveRepository = $advisorsApproveRepo;
        $this->basicInformationRepository = $basicRepo;
        $this->presentRepository = $presentRepo;
        $this->userAdvisorRepository = $userAdvisorRepo;
    }

    /**
     * Display a listing of the AdvisorsApprove.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->advisorsApproveRepository->pushCriteria(new RequestCriteria($request));
        $advisorsApproves = $this->advisorsApproveRepository->all();

        $auth = Auth::user();
        $students = $this->basicInformationRepository->findWhere(['adviser_id' => $auth->id]);

        return view('advisors_approves.index')
            ->with('students', $students)
            ->with('advisorsApproves', $advisorsApproves);
    }

    /**
     * Show the form for creating a new AdvisorsApprove.
     *
     * @return Response
     */
    public function create()
    {
        return view('advisors_approves.create');
    }

    /**
     * Store a newly created AdvisorsApprove in storage.
     *
     * @param CreateAdvisorsApproveRequest $request
     *
     * @return Response
     */
    public function store(CreateAdvisorsApproveRequest $request)
    {
        $input = $request->all();

        $advisorsApprove = $this->advisorsApproveRepository->create($input);

        Flash::success('Advisors Approve saved successfully.');

        return redirect(route('advisorsApproves.index'));
    }

    /**
     * Display the specified AdvisorsApprove.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        // $advisorsApprove = $this->advisorsApproveRepository->findWithoutFail($id);

        $approveds = $this->advisorsApproveRepository->findWhere(['student_id' => $id, 'advisor_id' => Auth::user()->id]);

        if (empty($approveds)) {
            Flash::error('Approve not found');

            return redirect(route('advisorsApproves.index'));
        }

        return view('advisors_approves.show')->with('approveds', $approveds);
    }

    /**
     * Show the form for editing the specified AdvisorsApprove.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $auth = Auth::user();
        $student = $this->basicInformationRepository
            ->findWhere(['adviser_id' => $auth->id, 'user_id' => $id])
            ->first();

        $roomAdvisor = $this->userAdvisorRepository->findWhere(['user_id' => $auth->id])->first();
        $roomId = $roomAdvisor->room_id;

        $presents = $this->presentRepository->findWhere(['room_id' => $roomId]);
        $presents = $presents->mapWithKeys(function ($item) {
            return [$item->id => $item->sequence->description];
        });
        // $advisorsApprove = $this->advisorsApproveRepository->findWithoutFail($id);

        if (empty($roomAdvisor)) {
            Flash::error('Advisors is not in the room');

            return redirect(route('advisorsApproves.index'));
        }

        return view('advisors_approves.edit')->with('presents', $presents)->with('student', $student);
    }

    /**
     * Update the specified AdvisorsApprove in storage.
     *
     * @param  int              $id
     * @param UpdateAdvisorsApproveRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdvisorsApproveRequest $request)
    {
        $input = $request->all();
        $input['advisor_id'] = Auth::user()->id;
        $input['student_id'] = $id;

        $advisorsApprove = $this->advisorsApproveRepository->create($input);

        Flash::success('Advisors Approve add successfully.');

        return redirect(route('advisorsApproves.index'));
    }

    /**
     * Remove the specified AdvisorsApprove from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $advisorsApprove = $this->advisorsApproveRepository->findWithoutFail($id);

        if (empty($advisorsApprove)) {
            Flash::error('Advisors Approve not found');

            return redirect(route('advisorsApproves.index'));
        }

        $this->advisorsApproveRepository->delete($id);

        Flash::success('Advisors Approve deleted successfully.');

        return redirect(route('advisorsApproves.index'));
    }
}
