<?php

namespace App\Http\Controllers\API;

use App\Models\TimeSheetModel;
use App\Service\TimeSheetService;
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
    protected $service, $logined, $memberId;

    function __construct(TimeSheetService $service)
    {
        $this->service = $service;


    }

    function registAttend(Request $request, $type)
    {
        if (Auth::check()) {
            $id = Auth::getUser()->getAttribute("id");

            $date = $request->input("date");
            $time = $request->input("time");
            if ($type == "start") {
                Log::debug($date);
                Log::debug($time);
                $result = $this->service->saveTimeSheetStart($id, $date,$time);


            } else {
                $result = $this->service->saveTimeSheetEnd($id, $date,$time);
            }

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


            $result = $this->service->getTimeSheetList($id, $term ,$date);

            return response()->json($result);
        }


    }

    function currentDayShift(Request $request)
    {
        if (Auth::check()) {


            $id = Auth::getUser()->getAttribute("id");

            $result = $this->service->getShift($id,Carbon::today());

            return response()->json($result);
        }




    }

}
