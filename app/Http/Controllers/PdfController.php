<?php

namespace App\Http\Controllers;

use App\Repositories\Basic_informationRepository;
use App\Repositories\CheckPresentRepository;
use App\Repositories\PresentRepository;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Prettus\Repository\Criteria\RequestCriteria;

class PdfController extends Controller
{
    //
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

    public function index($advisor, $year, Request $request)
    {
        $total = 0;
        $checkPresentCount = 0;
        $checkPresentPayCount = 0;
        $student = 0;
        $auth = Auth::user();

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
        $checkPresentCount = $checkPresentData->count('id');
        # Count Report pay
        $checkPresentPayData = $this->checkPresentRepository->findWhere(['user_id' => $auth->id, 'pay_status' => 1]);
        $checkPresentPayData = $checkPresentPayData->filter(function ($cp) use ($year) {
            return $cp->present->sequence->year == $year;
        });
        $checkPresentPayCount = $checkPresentPayData->count('id');

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

        // PDF::setOptions(['defaultFont' => 'Tahoma', 'fontDir' => storage_path('fonts/')]);
        $data = compact('auth', 'checkPresents', 'checkPresentCount', 'checkPresentPayCount', 'total', 'year');
        // dd($data);
        $pdf = PDF::loadView('pdf.index', $data);
        // return @$pdf->stream();
        // return $pdf->download('invoice.pdf');
        return view('pdf.index', $data);
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
}
