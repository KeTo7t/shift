<?php

namespace App\Http\Controllers\API;


use App\Service\ReportFormatService;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReportFormatAPIController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $service, $logined, $memberId;

    function __construct(ReportFormatService $service)
    {
        $this->service = $service;


    }
    function getReportFormat(Request $request)
    {
        if (Auth::check()) {


$res=            $this->service->getReportFormat(1);
print_r($res,true);
            return $res;

        }




    }
    function SaveReportFormat(Request $request){
        if(!$request->session()->get("logined") ) {
            return view("manageReportFormat");
        }


    }
}
