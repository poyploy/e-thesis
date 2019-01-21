<?php

namespace App\Http\Controllers;

use App\Repositories\RoomUserRepository;
use App\Repositories\UploadFileRepository;
use App\Repositories\UserAdvisorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvisorFileUploadController extends Controller
{
    /** @var  UploadFileRepository */
    private $uploadFileRepository;

    /** @var  UserAdvisorRepository */
    private $userAdvisorRepository;

    /** @var  RoomUserRepository */
    private $roomUserRepository;
    //

    public function __construct(UploadFileRepository $uploadFileRepo, RoomUserRepository $roomUserRepo, UserAdvisorRepository $userAdvisorRepo)
    {
        $this->userAdvisorRepository = $userAdvisorRepo;
        $this->roomUserRepository = $roomUserRepo;
        $this->uploadFileRepository = $uploadFileRepo;
    }

    public function index(Request $request)
    {
        $auth = Auth::user();
        $userAdvisors = $this->userAdvisorRepository->findWhere(['user_id' => $auth->id]);
        return view('advisor_fileupload.index')
            ->with('userAdvisors', $userAdvisors);
    }

    public function show($roomId, Request $request)
    {
        $roomUsers = $this->roomUserRepository->with('user')->findWhere(['room_id' => $roomId]);
        if (empty($roomUsers)) {
            Flash::error('Room User not found');

            return redirect(route('advisorFileUploads.index'));
        }
        return view('advisor_fileupload.show')
            ->with('roomUsers', $roomUsers);
    }

    public function showDetail($userId, $roomId, Request $request)
    {
        $files = $this->uploadFileRepository->findWhere(['user_id'=>$userId]);
        // if (empty($files)) {
        //     Flash::error('Room User not found');

        //     return redirect(route('advisorFileUploads.index'));
        // }
        // $roomUsers = $this->roomUserRepository->with('user')->findWhere(['room_id' => $roomId]);
        // if (empty($roomUsers)) {
        //     Flash::error('Room User not found');

        //     return redirect(route('advisorFileUploads.index'));
        // }
        return view('advisor_fileupload.show_detail')
        ->with('roomId', $roomId)
            ->with('files', $files);
    }
}
