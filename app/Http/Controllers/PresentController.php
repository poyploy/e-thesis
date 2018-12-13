<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePresentRequest;
use App\Http\Requests\UpdatePresentRequest;
use App\Repositories\PresentRepository;
use App\Repositories\SequenceRepository;
use App\Repositories\RoomRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PresentController extends AppBaseController
{
    /** @var  PresentRepository */
    private $presentRepository;

    /** @var  SequenceRepository */
    private $sequenceRepository;

    private $roomRepository;

    public function __construct(PresentRepository $presentRepo,SequenceRepository $sequenceRepo,RoomRepository $roomRepo)
    {
        $this->presentRepository = $presentRepo;
        $this->sequenceRepository = $sequenceRepo;
        $this->roomRepository = $roomRepo;
    }

    /**
     * Display a listing of the Present.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->presentRepository->pushCriteria(new RequestCriteria($request));
        $presents = $this->presentRepository->all();

        return view('presents.index')
            ->with('presents', $presents);
    }

    /**
     * Show the form for creating a new Present.
     *
     * @return Response
     */
    public function create()
    {
        $Year = Carbon::now()->format('Y');
        $Year = (int) $Year;
        $years = ['' => ''];
        for ($i = $Year; $i < $Year + 10; $i++) {
            $years['' . $i] = $i;
        }


        return view('presents.create')->with(['years' => $years]);
    }

    /**
     * Store a newly created Present in storage.
     *
     * @param CreatePresentRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $year = $request->input('year');

        //query sequence data by year
        $sequences =  $this->sequenceRepository->findWhere(['year' => $year]);
        //query room data by status and year
        $rooms =  $this->roomRepository->findWhere(['status' => 1,'year' => $year]);
        foreach($rooms as $room){
            foreach($sequences as $sequence){
                $this->presentRepository->create([
                    'date' =>  $sequence->date_time,
                    'sequence_id' => $sequence->id,
                    'room_id' => $room->id,
                ]);
            }
        }

        Flash::success('Present saved successfully.');

        return redirect(route('presents.index'));
    }

    /**
     * Display the specified Present.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $present = $this->presentRepository->findWithoutFail($id);

        if (empty($present)) {
            Flash::error('Present not found');

            return redirect(route('presents.index'));
        }

        return view('presents.show')->with('present', $present);
    }

    /**
     * Show the form for editing the specified Present.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $present = $this->presentRepository->findWithoutFail($id);

        if (empty($present)) {
            Flash::error('Present not found');

            return redirect(route('presents.index'));
        }

        return view('presents.edit')->with('present', $present);
    }

    /**
     * Update the specified Present in storage.
     *
     * @param  int              $id
     * @param UpdatePresentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePresentRequest $request)
    {
        $present = $this->presentRepository->findWithoutFail($id);

        if (empty($present)) {
            Flash::error('Present not found');

            return redirect(route('presents.index'));
        }

        $present = $this->presentRepository->update($request->all(), $id);

        Flash::success('Present updated successfully.');

        return redirect(route('presents.index'));
    }

    /**
     * Remove the specified Present from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $present = $this->presentRepository->findWithoutFail($id);

        if (empty($present)) {
            Flash::error('Present not found');

            return redirect(route('presents.index'));
        }

        $this->presentRepository->delete($id);

        Flash::success('Present deleted successfully.');

        return redirect(route('presents.index'));
    }
}
