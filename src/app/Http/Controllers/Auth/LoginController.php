<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\SocialAccount;

use Illuminate\Http\Request;
use Laravel\Socialite\Two\GoogleProvider;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        Log::debug("ログインチェック");
        if (Auth::check()) {
            Log::debug("ログイン済み");


        }

        $this->middleware('guest')->except('logout');


    }

    /**
     * redirect to oauth page
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {

        return Socialite::driver($provider)->redirect();
    }

    /**
     * get user info from oauth
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request, $provider)
    {


        /* @var  \Laravel\Socialite\Two\User $user */
        /* @var  GoogleProvider $socialite */

        $socialite= Socialite::driver($provider);
//        dump($socialite);
//        dump($request->session()->pull('state'));
//        dump($request->input('state'));
//        exit;
        $user = $socialite->user();


        if (empty(Auth::getUser())) {
            $user = User::firstOrCreate([
                'name' => $user->getName(),
                'email' => $user->getEmail()
            ]);
            Auth::login($user);
        }


        return redirect($this->redirectTo);
    }

}
