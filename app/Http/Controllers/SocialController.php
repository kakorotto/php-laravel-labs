<?php

namespace App\Http\Controllers;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class SocialController extends Controller
{

    public function redirect($provider)
    {
        
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $userProviderInfo = Socialite::driver($provider)->user();

        $user = $this->getUser($userProviderInfo, $provider);
        auth()->login($user);
        return redirect()->to('/posts');
    }

    public function getUser($userProviderInfo, $provider)
    {
        $user = User::where('github_id', $userProviderInfo->id)->first() ? User::where('github_id', $userProviderInfo->id)->first() : User::where('email', $userProviderInfo->email)->first();
        if (!$user) {
            if($provider==="github"){
            $user = User::create([
                'name' => $userProviderInfo->nickname,
                'email' => $userProviderInfo->email,
                'github_id' => $userProviderInfo->id,
                'github_token' => $userProviderInfo->token,
                'password' => '',

            ]);
        }elseif($provider==="google"){
            $user = User::create([
                'name' => $userProviderInfo->name,
                'email' => $userProviderInfo->email,
                'google_token' => $userProviderInfo->token,
                'google_id'=> $userProviderInfo->id,
                'password' => '',

            ]);


        }
        }
        return $user;
    }
}
