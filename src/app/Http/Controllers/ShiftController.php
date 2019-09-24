<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;

class ShiftController extends BaseController
{
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;




    function index(Request $request){
         return view("shift");

    }




}
