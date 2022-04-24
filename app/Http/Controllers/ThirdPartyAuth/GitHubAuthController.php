<?php

namespace App\Http\Controllers\ThirdPartyAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GitHubAuthController extends Controller
{
    public function authenticate() {
        $githubUser = Socialite::driver('github')->user();
        // dd($githubUser);
        $user = User::updateOrCreate([
            'email'=>$githubUser->email
        ], [
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'github_token' => $githubUser->token,
            'password'=>$githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);

        Auth::login($user);

        return to_route('posts.index');
    }
    public function redirect () {
        return Socialite::driver('github')->redirect();
    }
}
