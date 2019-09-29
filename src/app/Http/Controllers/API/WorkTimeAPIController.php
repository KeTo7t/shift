<?php

namespace App\Http\Controllers\API;

use App\Models\TimeSheetModel;
use App\Service\TimeSheetService;
use App\Service\WorkShiftService;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class WorkTimeAPIController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $timeSheetService, $logined, $memberId;

    function __construct(TimeSheetService $timeSheetService)
    {
        $this->timeSheetService = $timeSheetService;


    }

    function registAttend(Request $request, $type)
    {
        if (Auth::check()) {
            $id = Auth::getUser()->getAttribute("id");

            $date = $request->input("params.date");
            $time = $request->input("params.time");
            $result = $this->timeSheetService->saveTimeSheet($type,$id, $date,$time);


            if ($result == true) {
                return response("登録成功", 200);
            } else {
                return response("登録エラー", 500);
            }

        }


    }

    function timelist(Request $request)
    {


        if (Auth::check()) {


            $date = $request->input("date",null);

            $term= $request->input("term","currentMonth");

            $id = Auth::getUser()->getAttribute("id");


            $result = $this->timeSheetService->getTimeSheetList($id, $term ,$date);

            return response()->json($result);
        }


    }

    function currentDayShift(Request $request)
    {
        if (Auth::check()) {


            $id = Auth::getUser()->getAttribute("id");

            $result = $this->timeSheetService->getShift($id,Carbon::today());

            return response()->json($result);
        }




    }

}
