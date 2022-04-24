<?php

namespace App\Http\Controllers\ThirdPartyAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FaceBookAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function authenticate() {
        $facebookUser = Socialite::driver('facebook')->user();
        // dd($facebookUser);
        $user = User::updateOrCreate([
            'email'=>$facebookUser->email
        ], [
            'name' => $facebookUser->name,
            'email' => $facebookUser->email,
            'facebook_token' => $facebookUser->token,
            'password'=>$facebookUser->token,
            'github_refresh_token' => $facebookUser->refreshToken,
        ]);

        Auth::login($user);

        return to_route('posts.index');
    }
}
