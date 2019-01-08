<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateUploadFileRequest;
use App\Http\Requests\UpdateUploadFileRequest;
use App\Repositories\SequenceRepository;
use App\Repositories\UploadFileRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UploadFileController extends AppBaseController
{
    /** @var  UploadFileRepository */
    private $uploadFileRepository;

    /** @var  SequenceRepository */
    private $sequenceRepository;

    public function __construct(UploadFileRepository $uploadFileRepo, SequenceRepository $sequenceRepo)
    {
        $this->sequenceRepository = $sequenceRepo;
        $this->uploadFileRepository = $uploadFileRepo;
    }

    /**
     * Display a listing of the UploadFile.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->uploadFileRepository->pushCriteria(new RequestCriteria($request));

        $user = Auth::user();
        $uploadFiles = $this->uploadFileRepository->findWhere(['user_id' => $user->id]);

        return view('upload_files.index')
            ->with('uploadFiles', $uploadFiles);
    }

    /**
     * Show the form for creating a new UploadFile.
     *
     * @return Response
     */
    public function create()
    {
        $sequences = $this->sequenceRepository->findWhere(['uploadfile_status' => '1']);
        $sequences = $sequences->mapWithKeys(function ($item) {
            return [$item['id'] => $item['description']];
        });

        return view('upload_files.create')->with('sequences', $sequences);
    }

    /**
     * Store a newly created UploadFile in storage.
     *
     * @param CreateUploadFileRequest $request
     *
     * @return Response
     */
    public function store(CreateUploadFileRequest $request)
    {
        $input = $request->all();

        $uploadFile = $this->uploadFileRepository->create($input);

        Flash::success('Upload File saved successfully.');

        return redirect(route('uploadFiles.index'));
    }

    /**
     * Display the specified UploadFile.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $uploadFile = $this->uploadFileRepository->findWithoutFail($id);

        if (empty($uploadFile)) {
            Flash::error('Upload File not found');

            return redirect(route('uploadFiles.index'));
        }

        return view('upload_files.show')->with('uploadFile', $uploadFile);
    }

    /**
     * Show the form for editing the specified UploadFile.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $uploadFile = $this->uploadFileRepository->findWithoutFail($id);

        if (empty($uploadFile)) {
            Flash::error('Upload File not found');

            return redirect(route('uploadFiles.index'));
        }

        return view('upload_files.edit')->with('uploadFile', $uploadFile);
    }

    /**
     * Update the specified UploadFile in storage.
     *
     * @param  int              $id
     * @param UpdateUploadFileRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUploadFileRequest $request)
    {
        $uploadFile = $this->uploadFileRepository->findWithoutFail($id);

        if (empty($uploadFile)) {
            Flash::error('Upload File not found');

            return redirect(route('uploadFiles.index'));
        }

        $uploadFile = $this->uploadFileRepository->update($request->all(), $id);

        Flash::success('Upload File updated successfully.');

        return redirect(route('uploadFiles.index'));
    }

    /**
     * Remove the specified UploadFile from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $uploadFile = $this->uploadFileRepository->findWithoutFail($id);

        if (empty($uploadFile)) {
            Flash::error('Upload File not found');

            return redirect(route('uploadFiles.index'));
        }

        $this->uploadFileRepository->delete($id);

        Flash::success('Upload File deleted successfully.');

        return redirect(route('uploadFiles.index'));
    }
}
