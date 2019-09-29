<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\userRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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


    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request ,userRepository $userRepository)
    {

        $this->userRepository = $userRepository;


        Log::debug("ログインチェック");
        if (Auth::check()) {
            Log::debug("ログイン済み");


        } else {
            Log::debug("未ログイン");
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


        Log::debug(      $request->hasSession());
        /* @var  \Laravel\Socialite\Two\User $user */
        /* @var  GoogleProvider $socialite */

        $socialite = Socialite::driver($provider);
        $user = $socialite->user();
$email=$user->getEmail();

        if ($request->hasSession()) {
            Log::debug( "dddd");
            return redirect($this->redirectTo);
        }elseif($this->userRepository->emailExists($email)){
            Auth::login($user);
            return redirect($this->redirectTo);

        };

        if (empty(Auth::getUser())) {
            Log::debug( "ccc");
            $user = [
                'name' => $user->getName(),
                'email' => $user->getEmail()];

            return view("regist_user", $user);

        }

        Log::debug( "aabbb");
        return redirect($this->redirectTo);
    }


    public function registUser(Request $request)
    {
        Log::debug($request->input());

        Log::debug($request->post());
        $name = $request->input("name");
        $email = $request->input("email");
        $user = $this->userRepository->registUser($name, $email);

        $login = Auth::login($user);

        return redirect($this->redirectTo);
    }
}
