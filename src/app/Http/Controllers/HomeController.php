<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;




    function index(Request $request){
        if(!$request->session()->get("logined") ) {
            return view("login");
        }
        redirect("/attend");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function attend(Request $request){

        Log::debug("attend");

 //       if($request->session()->get("logined") ){
        if(\Auth::check()){
            Log::debug("abababab");
//            print_r($request->session()->all());
            return view("attend");
        }else{

            Log::debug("cbcbcbcb");


            return view("login");
        }



    }






    function logout(Request $request){
        if(Auth::check()){
            echo "now is logined. do logout.<br>";
            Auth::logout();
        }{
            echo "not logined<br>";
            return view("login");
        }


//        print_r($request->session()->all());
    }
}
