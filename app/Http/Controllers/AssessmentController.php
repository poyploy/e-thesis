<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateAssessmentRequest;
use App\Http\Requests\UpdateAssessmentRequest;
use App\Repositories\AssessmentRepository;
use App\Repositories\Basic_informationRepository;
use App\Repositories\FormAssessmentRepository;
use App\Repositories\PresentRepository;
use App\Repositories\UserRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AssessmentController extends AppBaseController
{

    /** @var  UserRepository */
    private $userRepository;
   
    /** @var  FormAssessmentRepository */
    private $formAssessmentRepository;

    /** @var  PresentRepository */
    private $presentRepository;

    /** @var  Basic_informationRepository */
    private $basicInformationRepository;

    /** @var  AssessmentRepository */
    private $assessmentRepository;

    public function __construct(UserRepository $userRepo,FormAssessmentRepository $formAssessmentRepo, PresentRepository $presentRepo, Basic_informationRepository $basicInformationRepo, AssessmentRepository $assessmentRepo)
    {
        $this->assessmentRepository = $assessmentRepo;
        $this->basicInformationRepository = $basicInformationRepo;
        $this->presentRepository = $presentRepo;
        $this->formAssessmentRepository = $formAssessmentRepo;
        $this->userRepository = $userRepo;

        // dd('__construct');
    }

    /**
     * Display a listing of the Assessment.
     *
     * @param Request $request
     * @return Response
     */
    public function storeScore(Request $request)
    {
        $input = $request->all();
        $present = $this->presentRepository->findWithoutFail($input['present_id']);
        if (empty($present)) {
            Flash::error('Present not found.');
            return back();
        }
        $input['room_id'] = $present->room_id;

        //เช็คว่าประเมินแล้ว
        $auth = Auth::user();
        $count = $this->assessmentRepository
            ->findWhere([
                'user_id' => $input['user_id'],
                'present_id' => $input['present_id'],
                'teacher_id' => $auth->id,
            ])->count();

        if ($count > 0) {
            Flash::error('Present is already in assessment.');
            return back();
        }

        $input['teacher_id'] = $auth->id;
        $values = $input['form_value'];
        $formKeys = $input['form_keys'];
        foreach ($formKeys as $key => $formId) {
            $value = $values[$formId];
            $input['assessment_score1'] = $value;
            $input['sequence_id'] = $present->sequence_id;
            $input['form_id'] = $formId;
            $this->assessmentRepository->create($input);
        }

        Flash::success('Assessment saved successfully.');
        return redirect()->route('advisorUserPresents.showDetail', [$present->id, $present->room_id]);

    }

    /**
     * Display a listing of the Assessment.
     *
     * @param Request $request
     * @return Response
     */
    public function updateStudentScore(Request $request)
    {
        //  dd("presentRepository start of function");
        $input = $request->all();
      
        $present = $this->presentRepository->findWithoutFail($input['present_id']);
       
        if (empty($present)) {
            dd("presentRepository end of function");
            // Flash::error('Present not found.');
            // return back();
        }
       
        $auth = Auth::user();

        $input['room_id'] = $present->room_id;
        $input['teacher_id'] = $auth->id;
        $values = $input['form_value'];
        $formKeys = $input['form_keys'];
       
        foreach ($formKeys as $key => $formId) {
            $value = $values[$formId];
            
            $input['assessment_score1'] = $value;
            $input['sequence_id'] = $present->sequence_id;
            $input['form_id'] = $formId;
            $assess = $this->assessmentRepository->findWhere([
                'sequence_id' => $present->sequence_id , 
                'form_id' => $formId,
                'user_id' =>  $input['user_id'],
                'teacher_id' => $input['teacher_id'],
                'present_id' => $input['present_id'],
            ])->first();
                // dd($assess);
            if(!empty($assess)){
                $this->assessmentRepository->update($input, $assess->id);
            }else{
                $this->assessmentRepository->create($input);
            }

        }
        // dd("presenformKeys   tRepository start of function");
        Flash::success('Assessment saved successfully.');
        // dd("end of function");
        return redirect()->route('advisorUserPresents.showDetail', [$present->id, $present->room_id]);

    }
    
    /**
     * Display a listing of the Assessment.
     *
     * @param Request $request
     * @return Response
     */
    public function scoreAvg($userId, $presentId, Request $request)
    {
        $auth = Auth::user();

        $assessments = $this->assessmentRepository
            ->findWhere([
                'user_id' => $userId,
                'present_id' => $presentId,
            ]);

        $groupteacher = $assessments->groupBy('teacher_id');

        $summary = \DB::table('assessment')->selectRaw(' user_id , form_id, avg(assessment_score1) as avg_score')
        ->whereRaw('user_id = ? and present_id = ?', [$userId, $presentId])->groupBy('form_id' , 'user_id')->get();
       // TODO : comment
        // dd($groupteacher , $summary);

        foreach ($groupteacher as $key => $teacher) {
            foreach ($teacher as $key => $value) {
                $value->user = $this->userRepository->findWithoutFail($value->user_id);
                $value->teacher = $this->userRepository->findWithoutFail($value->teacher_id);
            }
        }
       $user = $this->userRepository->findWithoutFail($userId);
       $teacher = $this->userRepository->findWithoutFail($userId);
    //    $title = $this->formAssessmentRepository->findWithoutFail($id);
    //    dd($user);
        return view('advisor_user_presents.scoreavg')
            ->with('groupteacher', $groupteacher)
            ->with('user', $user)
            ->with('teacher', $teacher)
            ->with('summary', $summary);
            // ->with('title', $title);
    }

    /**
     * Display a listing of the Assessment.
     *
     * @param Request $request
     * @return Response
     */
    public function score($userId, $presentId, Request $request)
    {
        $auth = Auth::user();

        $count = $this->assessmentRepository
            ->findWhere([
                'user_id' => $userId,
                'present_id' => $presentId,
                'teacher_id' => $auth->id,
            ])->count();

        if ($count > 0) {
            Flash::error('Present is already in assessment.');
            return back();
        }

        $present = $this->presentRepository->findWithoutFail($presentId);

        $form = $this->formAssessmentRepository->findWhere(['sequence_id' => $present->sequence_id]);

        $user = $this->basicInformationRepository->findWhere(['user_id' => $userId])->first();

        return view('assessments.score')
            ->with('form', $form)
            ->with('present', $present)
            ->with('user', $user);
    }

    /**
     * Display a listing of the Assessment.
     *
     * @param Request $request
     * @return Response
     */
    public function scoreEdit($userId, $presentId, Request $request)
    {
        $auth = Auth::user();

        $assessments = $this->assessmentRepository
            ->findWhere([
                'user_id' => $userId,
                'present_id' => $presentId,
                'teacher_id' => $auth->id,
            ]);

        $assessments = $assessments->groupBy('form_id');

        $present = $this->presentRepository->findWithoutFail($presentId);

        $form = $this->formAssessmentRepository->findWhere(['sequence_id' => $present->sequence_id]);

        $user = $this->basicInformationRepository->findWhere(['user_id' => $userId])->first();


        // dd($assessments[1]->first()->assessment_score1);
        return view('assessments.score')
            ->with('form', $form)
            ->with('assessments', $assessments)
            ->with('present', $present)
            ->with('user', $user);
    }

    /**
     * Display a listing of the Assessment.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->assessmentRepository->pushCriteria(new RequestCriteria($request));
        $assessments = $this->assessmentRepository->all();

        return view('assessments.index')
            ->with('assessments', $assessments);
    }

    /**
     * Show the form for creating a new Assessment.
     *
     * @return Response
     */
    public function create()
    {
        return view('assessments.create');
    }

    /**
     * Store a newly created Assessment in storage.
     *
     * @param CreateAssessmentRequest $request
     *
     * @return Response
     */
    public function store(CreateAssessmentRequest $request)
    {
        $input = $request->all();

        $assessment = $this->assessmentRepository->create($input);

        Flash::success('Assessment saved successfully.');

        return redirect(route('assessments.index'));
    }

    /**
     * Display the specified Assessment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $assessment = $this->assessmentRepository->findWithoutFail($id);

        if (empty($assessment)) {
            Flash::error('Assessment not found');

            return redirect(route('assessments.index'));
        }

        return view('assessments.show')->with('assessment', $assessment);
    }

    /**
     * Show the form for editing the specified Assessment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $assessment = $this->assessmentRepository->findWithoutFail($id);

        if (empty($assessment)) {
            Flash::error('Assessment not found');

            return redirect(route('assessments.index'));
        }

        return view('assessments.edit')->with('assessment', $assessment);
    }

    /**
     * Update the specified Assessment in storage.
     *
     * @param  int              $id
     * @param UpdateAssessmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAssessmentRequest $request)
    {
        $assessment = $this->assessmentRepository->findWithoutFail($id);

        if (empty($assessment)) {
            Flash::error('Assessment not found');

            return redirect(route('assessments.index'));
        }

        $assessment = $this->assessmentRepository->update($request->all(), $id);

        Flash::success('Assessment updated successfully.');

        return redirect(route('assessments.index'));
    }

    /**
     * Remove the specified Assessment from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $assessment = $this->assessmentRepository->findWithoutFail($id);

        if (empty($assessment)) {
            Flash::error('Assessment not found');

            return redirect(route('assessments.index'));
        }

        $this->assessmentRepository->delete($id);

        Flash::success('Assessment deleted successfully.');

        return redirect(route('assessments.index'));
    }
}
