<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCheckPresentRequest;
use App\Http\Requests\UpdateCheckPresentRequest;
use App\Repositories\CheckPresentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CheckPresentController extends AppBaseController
{
    /** @var  CheckPresentRepository */
    private $checkPresentRepository;

    public function __construct(CheckPresentRepository $checkPresentRepo)
    {
        $this->checkPresentRepository = $checkPresentRepo;
    }

    /**
     * Display a listing of the CheckPresent.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->checkPresentRepository->pushCriteria(new RequestCriteria($request));
        $checkPresents = $this->checkPresentRepository->all();

        return view('check_presents.index')
            ->with('checkPresents', $checkPresents);
    }

    /**
     * Show the form for creating a new CheckPresent.
     *
     * @return Response
     */
    public function create()
    {
        return view('check_presents.create');
    }

    /**
     * Store a newly created CheckPresent in storage.
     *
     * @param CreateCheckPresentRequest $request
     *
     * @return Response
     */
    public function store(CreateCheckPresentRequest $request)
    {
        $input = $request->all();

        $checkPresent = $this->checkPresentRepository->create($input);

        Flash::success('Check Present saved successfully.');

        return redirect(route('checkPresents.index'));
    }

    /**
     * Display the specified CheckPresent.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $checkPresent = $this->checkPresentRepository->findWithoutFail($id);

        if (empty($checkPresent)) {
            Flash::error('Check Present not found');

            return redirect(route('checkPresents.index'));
        }

        return view('check_presents.show')->with('checkPresent', $checkPresent);
    }

    /**
     * Show the form for editing the specified CheckPresent.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $checkPresent = $this->checkPresentRepository->findWithoutFail($id);

        if (empty($checkPresent)) {
            Flash::error('Check Present not found');

            return redirect(route('checkPresents.index'));
        }

        return view('check_presents.edit')->with('checkPresent', $checkPresent);
    }

    /**
     * Update the specified CheckPresent in storage.
     *
     * @param  int              $id
     * @param UpdateCheckPresentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCheckPresentRequest $request)
    {
        $checkPresent = $this->checkPresentRepository->findWithoutFail($id);

        if (empty($checkPresent)) {
            Flash::error('Check Present not found');

            return redirect(route('checkPresents.index'));
        }

        $checkPresent = $this->checkPresentRepository->update($request->all(), $id);

        Flash::success('Check Present updated successfully.');

        return redirect(route('checkPresents.index'));
    }

    /**
     * Remove the specified CheckPresent from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $checkPresent = $this->checkPresentRepository->findWithoutFail($id);

        if (empty($checkPresent)) {
            Flash::error('Check Present not found');

            return redirect(route('checkPresents.index'));
        }

        $this->checkPresentRepository->delete($id);

        Flash::success('Check Present deleted successfully.');

        return redirect(route('checkPresents.index'));
    }
}
