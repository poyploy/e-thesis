<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateSequenceRequest;
use App\Http\Requests\UpdateSequenceRequest;
use App\Repositories\SequenceRepository;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SequenceController extends AppBaseController
{
    /** @var  SequenceRepository */
    private $sequenceRepository;

    public function __construct(SequenceRepository $sequenceRepo)
    {
        $this->sequenceRepository = $sequenceRepo;
    }

    /**
     * Display a listing of the Sequence.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->sequenceRepository->pushCriteria(new RequestCriteria($request));
        $sequences = $this->sequenceRepository->all();

        return view('sequences.index')
            ->with('sequences', $sequences);
    }

    /**
     * Show the form for creating a new Sequence.
     *
     * @return Response
     */
    public function create()
    {
        //
        $Year = Carbon::now()->format('Y');
        $Year = (int) $Year-2;
       // dd(  $Year );
        $years = ['' => ''];
        for ($i = $Year; $i < $Year + 10; $i++) {
            $years['' . $i] = $i;
        }

        //dd($years);

        return view('sequences.create')->with(['years' => $years]);
    }

    /**
     * Store a newly created Sequence in storage.
     *
     * @param CreateSequenceRequest $request
     *
     * @return Response
     */
    public function store(CreateSequenceRequest $request)
    {
        $input = $request->all();

        $sequence = $this->sequenceRepository->create($input);

        Flash::success('Sequence saved successfully.');

        return redirect(route('sequences.index'));
    }

    /**
     * Display the specified Sequence.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sequence = $this->sequenceRepository->findWithoutFail($id);

        if (empty($sequence)) {
            Flash::error('Sequence not found');

            return redirect(route('sequences.index'));
        }

        return view('sequences.show')->with('sequence', $sequence);
    }

    /**
     * Show the form for editing the specified Sequence.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sequence = $this->sequenceRepository->findWithoutFail($id);

        if (empty($sequence)) {
            Flash::error('Sequence not found');

            return redirect(route('sequences.index'));
        }

        $Year = Carbon::now()->format('Y');
        $Year = (int) $Year-2;
        $years = ['' => ''];
        for ($i = $Year; $i < $Year + 10; $i++) {
            $years['' . $i] = $i;
        }

        return view('sequences.edit')->with('sequence', $sequence)->with(['years' => $years]);
    }

    /**
     * Update the specified Sequence in storage.
     *
     * @param  int              $id
     * @param UpdateSequenceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSequenceRequest $request)
    {
        $sequence = $this->sequenceRepository->findWithoutFail($id);

        if (empty($sequence)) {
            Flash::error('Sequence not found');

            return redirect(route('sequences.index'));
        }

        $sequence = $this->sequenceRepository->update($request->all(), $id);

        Flash::success('Sequence updated successfully.');

        return redirect(route('sequences.index'));
    }

    /**
     * Remove the specified Sequence from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sequence = $this->sequenceRepository->findWithoutFail($id);

        if (empty($sequence)) {
            Flash::error('Sequence not found');

            return redirect(route('sequences.index'));
        }

        $this->sequenceRepository->delete($id);

        Flash::success('Sequence deleted successfully.');

        return redirect(route('sequences.index'));
    }
}
