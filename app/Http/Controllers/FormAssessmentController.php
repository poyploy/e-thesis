<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateFormAssessmentRequest;
use App\Http\Requests\UpdateFormAssessmentRequest;
use App\Repositories\FormAssessmentRepository;
use App\Repositories\FormAssessmentSubRepository;
use App\Repositories\SequenceRepository;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class FormAssessmentController extends AppBaseController
{

    /** @var  FormAssessmentSubRepository */
    private $formAssessmentSubRepository;

    /** @var  SequenceRepository */
    private $sequenceRepository;

    /** @var  FormAssessmentRepository */
    private $formAssessmentRepository;

    public function __construct(FormAssessmentSubRepository $formAssessmentSubRepo, SequenceRepository $sequenceRepo, FormAssessmentRepository $formAssessmentRepo)
    {
        $this->formAssessmentRepository = $formAssessmentRepo;
        $this->sequenceRepository = $sequenceRepo;
        $this->formAssessmentSubRepository = $formAssessmentSubRepo;
    }

    /**
     * Display a listing of the FormAssessment.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->formAssessmentRepository->pushCriteria(new RequestCriteria($request));
        $formAssessments = $this->formAssessmentRepository->all();

        return view('form_assessments.index')
            ->with('formAssessments', $formAssessments);
    }

    /**
     * Show the form for creating a new FormAssessment.
     *
     * @return Response
     */
    public function detailCreate($id, Request $request)
    {

        $formAssessment = $this->formAssessmentRepository->findWithoutFail($id);

        if (empty($formAssessment)) {
            Flash::error('Form Assessment not found');

            return redirect(route('formAssessments.index'));
        }

        return view('form_assessments.detail_create')
            ->with('formAssessment', $formAssessment);
    }

    //
    public function detailUpdate($id, $detail, Request $request)
    {

        $formAssessment = $this->formAssessmentRepository->findWithoutFail($id);

        if (empty($formAssessment)) {
            Flash::error('Form Assessment not found');

            return redirect(route('formAssessments.index'));
        }

        $formAssessmentSub = $this->formAssessmentSubRepository->findWithoutFail($detail);

        if (empty($formAssessmentSub)) {
            Flash::error('Form Assessment Sub not found');

            return redirect(route('formAssessments.index'));
        }

        return view('form_assessments.detail_update')
            ->with('formAssessmentSub', $formAssessmentSub)
            ->with('formAssessment', $formAssessment);
    }

    public function detailUpdateStore($id, $detail, Request $request)
    {

        $formAssessment = $this->formAssessmentRepository->findWithoutFail($id);

        if (empty($formAssessment)) {
            Flash::error('Form Assessment not found');

            return redirect(route('formAssessments.index'));
        }
        $this->formAssessmentSubRepository->update($request->all(), $detail);

        Flash::success('Form Assessment saved successfully.');

        return redirect()->route('formAssessments.detail', $id);
    }

    public function detail($id, Request $request)
    {

        $formAssessment = $this->formAssessmentRepository->findWithoutFail($id);

        if (empty($formAssessment)) {
            Flash::error('Form Assessment not found');

            return redirect(route('formAssessments.index'));
        }

        $formAssessmentSubs = $this->formAssessmentSubRepository->findWhere(['form_id' => $id]);
        return view('form_assessments.detail')
            ->with('formAssessmentSubs', $formAssessmentSubs)
            ->with('formAssessment', $formAssessment);
    }

    //

    public function detailCreateStore($id, Request $request)
    {
        $formAssessment = $this->formAssessmentRepository->findWithoutFail($id);

        if (empty($formAssessment)) {
            Flash::error('Form Assessment not found');

            return redirect(route('formAssessments.index'));
        }
        $formAssessmentSubs = $this->formAssessmentSubRepository->create($request->all());
        Flash::success('Form Assessment saved successfully.');

        return redirect()->route('formAssessments.detail', $id);
    }

    /**
     * Show the form for creating a new FormAssessment.
     *
     * @return Response
     */
    public function create()
    {

        $sequences = $this->sequenceRepository->all();
        $sequences = $sequences->mapWithKeys(function ($item) {
            return [$item['id'] => $item['year'] . ' ' . $item['term'] . ' ' . $item['description']];
        });

        return view('form_assessments.create')->with('sequences', $sequences);
    }

    /**
     * Store a newly created FormAssessment in storage.
     *
     * @param CreateFormAssessmentRequest $request
     *
     * @return Response
     */
    public function store(CreateFormAssessmentRequest $request)
    {
        $input = $request->all();

        $formAssessment = $this->formAssessmentRepository->create($input);

        Flash::success('Form Assessment saved successfully.');

        return redirect(route('formAssessments.index'));
    }

    /**
     * Display the specified FormAssessment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $formAssessment = $this->formAssessmentRepository->findWithoutFail($id);

        if (empty($formAssessment)) {
            Flash::error('Form Assessment not found');

            return redirect(route('formAssessments.index'));
        }

        return view('form_assessments.show')->with('formAssessment', $formAssessment);
    }

    /**
     * Show the form for editing the specified FormAssessment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $formAssessment = $this->formAssessmentRepository->findWithoutFail($id);

        if (empty($formAssessment)) {
            Flash::error('Form Assessment not found');

            return redirect(route('formAssessments.index'));
        }

        return view('form_assessments.edit')->with('formAssessment', $formAssessment);
    }

    /**
     * Update the specified FormAssessment in storage.
     *
     * @param  int              $id
     * @param UpdateFormAssessmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFormAssessmentRequest $request)
    {
        $formAssessment = $this->formAssessmentRepository->findWithoutFail($id);

        if (empty($formAssessment)) {
            Flash::error('Form Assessment not found');

            return redirect(route('formAssessments.index'));
        }

        $formAssessment = $this->formAssessmentRepository->update($request->all(), $id);

        Flash::success('Form Assessment updated successfully.');

        return redirect(route('formAssessments.index'));
    }

    /**
     * Remove the specified FormAssessment from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $formAssessment = $this->formAssessmentRepository->findWithoutFail($id);

        if (empty($formAssessment)) {
            Flash::error('Form Assessment not found');

            return redirect(route('formAssessments.index'));
        }

        $this->formAssessmentRepository->delete($id);

        Flash::success('Form Assessment deleted successfully.');

        return redirect(route('formAssessments.index'));
    }
}
