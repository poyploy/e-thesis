<?php

namespace App\Http\Controllers;

use App\Repositories\Basic_informationRepository;
use App\Repositories\CheckPresentRepository;
use App\Repositories\PresentRepository;
use App\Repositories\SettingRepository;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;

class QRcodeController extends Controller
{

    /** @var  Basic_informationRepository */
    private $basicInformationRepository;

    /** @var  SettingRepository */
    private $settingRepository;

    /** @var  PresentRepository */
    private $presentRepository;

    /** @var  CheckPresentRepository */
    private $checkPresentRepository;

    public function __construct(Basic_informationRepository $basicInformationRepo, SettingRepository $settingRepo, PresentRepository $presentRepo, CheckPresentRepository $checkPresentRepo)
    {
        $this->settingRepository = $settingRepo;
        $this->presentRepository = $presentRepo;
        $this->checkPresentRepository = $checkPresentRepo;
        $this->basicInformationRepository = $basicInformationRepo;
    }
    //
    public function index(Request $request)
    {
        $total = 0;
        $checkPresentCount = 0;
        $checkPresentPayCount = 0;
        $student = 0;
        $auth = Auth::user();
        $years = (int) Carbon::now()->addYears(1)->format('Y');

        $year = $request->input('year');
        if (empty($year)) {
            $year = 0;
            $this->checkPresentRepository->pushCriteria(new RequestCriteria($request));
            $checkPresents = $this->checkPresentRepository->findWhere(['user_id' => $auth->id]);

            return view('qrcode.index')
                ->with('checkPresentCount', $checkPresentCount)
                ->with('student', $student)
                ->with('checkPresentPayCount', $checkPresentPayCount)
                ->with('total', $total)
                ->with('years', $years)
                ->with('year', $year)
                ->with('checkPresents', $checkPresents);
        }

        $this->checkPresentRepository->pushCriteria(new RequestCriteria($request));
        $checkPresents = $this->checkPresentRepository->findWhere(['user_id' => $auth->id]);
        $checkPresents = $checkPresents->filter(function ($cp) use ($year) {
            return $cp->present->sequence->year == $year;
        });
        # Count Report
        $checkPresentData = $this->checkPresentRepository->findWhere(['user_id' => $auth->id]);
        $checkPresentData = $checkPresentData->filter(function ($cp) use ($year) {
            return $cp->present->sequence->year == $year;
        });
        $checkPresentCount =  $checkPresentData->count('id');
        # Count Report pay
        $checkPresentPayData = $this->checkPresentRepository->findWhere(['user_id' => $auth->id, 'pay_status' => 1]);
        $checkPresentPayData = $checkPresentPayData->filter(function ($cp) use ($year) {
            return $cp->present->sequence->year == $year;
        });
        $checkPresentPayCount =  $checkPresentPayData->count('id');

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

        $basicInfos = $this->basicInformationRepository->findWhere(['adviser_id' => $auth->id]);
        foreach ($basicInfos as $key => $basicInfo) {
            # code...
            if ($basicInfo->user->year == $year) {
                $student++;
            }
        }
        return view('qrcode.index')
            ->with('student', $student)
            ->with('checkPresentCount', $checkPresentCount)
            ->with('checkPresentPayCount', $checkPresentPayCount)
            ->with('total', $total)
            ->with('years', $years)
            ->with('year', $year)
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
