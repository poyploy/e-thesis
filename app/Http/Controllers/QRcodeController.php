<?php

namespace App\Http\Controllers;

use App\Repositories\CheckPresentRepository;
use App\Repositories\PresentRepository;
use App\Repositories\SettingRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;

class QRcodeController extends Controller
{
    /** @var  SettingRepository */
    private $settingRepository;

    /** @var  PresentRepository */
    private $presentRepository;

    /** @var  CheckPresentRepository */
    private $checkPresentRepository;

    public function __construct(SettingRepository $settingRepo, PresentRepository $presentRepo, CheckPresentRepository $checkPresentRepo)
    {
        $this->settingRepository = $settingRepo;
        $this->presentRepository = $presentRepo;
        $this->checkPresentRepository = $checkPresentRepo;
    }
    //
    public function index(Request $request)
    {
        $auth = Auth::user();
        $this->checkPresentRepository->pushCriteria(new RequestCriteria($request));
        $checkPresents = $this->checkPresentRepository->findWhere(['user_id' => $auth->id]);
        # Count Report
        $checkPresentCount = $this->checkPresentRepository->findWhere(['user_id' => $auth->id])->count('id');
        $checkPresentPayCount = $this->checkPresentRepository->findWhere(['user_id' => $auth->id, 'pay_status' => 1])->count('id');

        $rate = 0;
        switch ($auth->advisor_type) {
            case "0":
                $rate = $this->getAdvisorRatePermanent();
                break;
            case "1":
                $rate = $this->getAdvisorRateTemp();
                break;
        }

        $total = $checkPresentPayCount * $rate;

        return view('qrcode.index')
            ->with('checkPresentCount', $checkPresentCount)
            ->with('checkPresentPayCount', $checkPresentPayCount)
            ->with('total', $total)
            ->with('checkPresents', $checkPresents);
    }

    private function getAdvisorRatePermanent()
    {
        $setting = $this->settingRepository->findWhere(['option' => 'ADVISOR_PERMANENT'])->first();
        if (empty($setting)) {
            return 0;
        }
        return (int) $setting->value;
    }

    private function getAdvisorRateTemp()
    {
        $setting = $this->settingRepository->findWhere(['option' => 'ADVISOR_TEMP'])->first();
        if (empty($setting)) {
            return 0;
        }
        return (int) $setting->value;
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
