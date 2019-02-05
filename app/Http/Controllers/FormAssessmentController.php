<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFormAssessmentRequest;
use App\Http\Requests\UpdateFormAssessmentRequest;
use App\Repositories\FormAssessmentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class FormAssessmentController extends AppBaseController
{
    /** @var  FormAssessmentRepository */
    private $formAssessmentRepository;

    public function __construct(FormAssessmentRepository $formAssessmentRepo)
    {
        $this->formAssessmentRepository = $formAssessmentRepo;
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
    public function create()
    {
        return view('form_assessments.create');
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
