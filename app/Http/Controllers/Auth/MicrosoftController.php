<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MicrosoftController extends Controller
{
    /**
     * Redirect the user to the Microsoft authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    /**
     * Obtain the user information from Microsoft.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $userSocial = Socialite::driver('microsoft')->user();
        // dd($userSocial);

        //check if user exists and log user in

        $user = User::where('email', $userSocial->email)->first();

        if ($user) {
            if (Auth::loginUsingId($user->id)) {
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }

        //else sign the user up
        $userSignup = User::create([
            'first_name' => $userSocial->user['givenName'],
            'last_name' => $userSocial->user['surname'],
            'email' => $userSocial->email,
            'password' => bcrypt(Str::random(10)),
        ]);

        //finally log the user in
        if ($userSignup) {
            if (Auth::loginUsingId($userSignup->id)) {
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }
    }
}
