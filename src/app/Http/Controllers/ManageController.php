<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ManageController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function index(Request $request){
        if(!$request->session()->get("logined") ) {
            return view("login");
        }
        redirect("/attend");
    }

    function ReportFormat(Request $request){
        if(!$request->session()->get("logined") ) {
            return view("manageReportFormat");
        }


    }


}
