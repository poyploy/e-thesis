<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateContentRequest;
use App\Http\Requests\UpdateContentRequest;
use App\Repositories\ContentRepository;
use App\Repositories\RoomRepository;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ContentController extends AppBaseController
{
    /** @var  ContentRepository */
    private $contentRepository;

    /** @var  RoomRepository */
    private $roomRepository;

    public function __construct(RoomRepository $roomRepo, ContentRepository $contentRepo)
    {
        $this->contentRepository = $contentRepo;
        $this->roomRepository = $roomRepo;
    }

    /**
     * Display a listing of the Content.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->contentRepository->pushCriteria(new RequestCriteria($request));
        $contents = $this->contentRepository->all();

        return view('contents.index')
            ->with('contents', $contents);
    }

    /**
     * Show the form for creating a new Content.
     *
     * @return Response
     */
    public function create()
    {
        return view('contents.create');
    }

    /**
     * Store a newly created Content in storage.
     *
     * @param CreateContentRequest $request
     *
     * @return Response
     */
    public function store(CreateContentRequest $request)
    {
        $input = $request->all();

        $content = $this->contentRepository->create($input);

        Flash::success('Content saved successfully.');

        return redirect(route('contents.index'));
    }

    /**
     * Display the specified Content.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            Flash::error('Content not found');

            return redirect(route('contents.index'));
        }

        return view('contents.show')->with('content', $content);
    }

    /**
     * Show the form for editing the specified Content.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            Flash::error('Content not found');

            return redirect(route('contents.index'));
        }

        return view('contents.edit')->with('content', $content);
    }

    public function send($id)
    {
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            Flash::error('Content not found');

            return redirect(route('contents.index'));
        }
        $rooms = $this->roomRepository->with(['roomUsers', 'userPresent'])->all();
        $rooms = $rooms->mapWithKeys(function ($item) {
            return [$item->id => $item->year . ' - ' . $item->name];
        });

        

        return view('contents.send')->with('content', $content)
            ->with('rooms', $rooms);
            
    }

    public function sendSubmit($id, Request $request)
    {
        $room_id = $request->input('room_id');

        $send_to_student = $request->input('send_to_student');
        $send_to_advisor = $request->input('send_to_advisor');

        $url = route('rooms.email.sendbyContent', [
            $room_id,
            $id,
            'send_to_student' => $send_to_student,
            'send_to_advisor' => $send_to_advisor,
        ]);

        return redirect($url);
    }

    /**
     * Update the specified Content in storage.
     *
     * @param  int              $id
     * @param UpdateContentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContentRequest $request)
    {
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            Flash::error('Content not found');

            return redirect(route('contents.index'));
        }

        $content = $this->contentRepository->update($request->all(), $id);

        Flash::success('Content updated successfully.');

        return redirect(route('contents.index'));
    }

    /**
     * Remove the specified Content from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            Flash::error('Content not found');

            return redirect(route('contents.index'));
        }

        $this->contentRepository->delete($id);

        Flash::success('Content deleted successfully.');

        return redirect(route('contents.index'));
    }
}
