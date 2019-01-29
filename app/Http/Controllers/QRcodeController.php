<?php

namespace App\Http\Controllers;

use App\Repositories\CheckPresentRepository;
use App\Repositories\PresentRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;

class QRcodeController extends Controller
{
    /** @var  PresentRepository */
    private $presentRepository;

    /** @var  CheckPresentRepository */
    private $checkPresentRepository;

    public function __construct(PresentRepository $presentRepo, CheckPresentRepository $checkPresentRepo)
    {
        $this->presentRepository = $presentRepo;
        $this->checkPresentRepository = $checkPresentRepo;
    }
    //
    public function index(Request $request)
    {
        $auth = Auth::user();
        $this->checkPresentRepository->pushCriteria(new RequestCriteria($request));
        $checkPresents = $this->checkPresentRepository->findWhere(['user_id' => $auth->id]);

        return view('qrcode.index')
            ->with('checkPresents', $checkPresents);
    }

    public function scan(Request $request)
    {

        return view('qrcode.qrcode');
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param CreateRoleRequest $request
     *
     * @return Response
     */
    public function store($code, Request $request)
    {
        $present = $this->presentRepository->findWhere(['code' => $code])->first();
        if (empty($present)) {
            Flash::error('Present not found');

            return redirect(route('qrcode.index'));
        }
        $auth = Auth::user();
        $count = $this->checkPresentRepository->findWhere(['user_id' => $auth->id, 'present_id' => $present->id])->count();
        if ($count > 0) {
            Flash::success('Scan successfully.');

            return redirect(route('qrcode.index'));
        }

        $this->checkPresentRepository->create([
            'check_status' => 1,
            'present_id' => $present->id,
            'user_id' => $auth->id,
        ]);

        Flash::success('Scan successfully.');

        return redirect(route('qrcode.index'));
    }

    /**
     * Display the specified Menu.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show()
    {

        return view('qrcode');
    }
}
