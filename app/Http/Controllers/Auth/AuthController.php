<?php

namespace App\Http\Controllers\Auth;

use App\FacebookService;
use App\User;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    /**
     * Create a new authentication controller instance.
     * @internal param FacebookService $facebookService
     */
    public function __construct()
    {

        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $facebookUser = Socialite::driver('facebook')->user();

        $user = FacebookService::userForFacebookUser($facebookUser);

        if(!$user)
        {
            $user = FacebookService::createUserForFacebookUser($facebookUser);
        }

        \Auth::login($user, true);
    }
}
