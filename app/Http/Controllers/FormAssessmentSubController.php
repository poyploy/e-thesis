<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFormAssessmentSubRequest;
use App\Http\Requests\UpdateFormAssessmentSubRequest;
use App\Repositories\FormAssessmentSubRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class FormAssessmentSubController extends AppBaseController
{
    /** @var  FormAssessmentSubRepository */
    private $formAssessmentSubRepository;

    public function __construct(FormAssessmentSubRepository $formAssessmentSubRepo)
    {
        $this->formAssessmentSubRepository = $formAssessmentSubRepo;
    }

    /**
     * Display a listing of the FormAssessmentSub.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->formAssessmentSubRepository->pushCriteria(new RequestCriteria($request));
        $formAssessmentSubs = $this->formAssessmentSubRepository->all();

        return view('form_assessment_subs.index')
            ->with('formAssessmentSubs', $formAssessmentSubs);
    }

    /**
     * Show the form for creating a new FormAssessmentSub.
     *
     * @return Response
     */
    public function create()
    {
        return view('form_assessment_subs.create');
    }

    /**
     * Store a newly created FormAssessmentSub in storage.
     *
     * @param CreateFormAssessmentSubRequest $request
     *
     * @return Response
     */
    public function store(CreateFormAssessmentSubRequest $request)
    {
        $input = $request->all();

        $formAssessmentSub = $this->formAssessmentSubRepository->create($input);

        Flash::success('Form Assessment Sub saved successfully.');

        return redirect(route('formAssessmentSubs.index'));
    }

    /**
     * Display the specified FormAssessmentSub.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $formAssessmentSub = $this->formAssessmentSubRepository->findWithoutFail($id);

        if (empty($formAssessmentSub)) {
            Flash::error('Form Assessment Sub not found');

            return redirect(route('formAssessmentSubs.index'));
        }

        return view('form_assessment_subs.show')->with('formAssessmentSub', $formAssessmentSub);
    }

    /**
     * Show the form for editing the specified FormAssessmentSub.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $formAssessmentSub = $this->formAssessmentSubRepository->findWithoutFail($id);

        if (empty($formAssessmentSub)) {
            Flash::error('Form Assessment Sub not found');

            return redirect(route('formAssessmentSubs.index'));
        }

        return view('form_assessment_subs.edit')->with('formAssessmentSub', $formAssessmentSub);
    }

    /**
     * Update the specified FormAssessmentSub in storage.
     *
     * @param  int              $id
     * @param UpdateFormAssessmentSubRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFormAssessmentSubRequest $request)
    {
        $formAssessmentSub = $this->formAssessmentSubRepository->findWithoutFail($id);

        if (empty($formAssessmentSub)) {
            Flash::error('Form Assessment Sub not found');

            return redirect(route('formAssessmentSubs.index'));
        }

        $formAssessmentSub = $this->formAssessmentSubRepository->update($request->all(), $id);

        Flash::success('Form Assessment Sub updated successfully.');

        return redirect(route('formAssessmentSubs.index'));
    }

    /**
     * Remove the specified FormAssessmentSub from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $formAssessmentSub = $this->formAssessmentSubRepository->findWithoutFail($id);

        if (empty($formAssessmentSub)) {
            Flash::error('Form Assessment Sub not found');

            return redirect(route('formAssessmentSubs.index'));
        }

        $this->formAssessmentSubRepository->delete($id);

        Flash::success('Form Assessment Sub deleted successfully.');

        return redirect(route('formAssessmentSubs.index'));
    }
}
