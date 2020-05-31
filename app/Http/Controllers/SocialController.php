<?php

namespace App\Http\Controllers;

use Socialite;
use App\Models\User;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    
    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();
        
        $user = $this->createUser($getInfo,$provider);
    
        auth()->login($user);
    
        return redirect('/')->with('thongbao', 'Đăng nhập bằng google thành công');
    }

    public function createUser($getInfo,$provider){
        $user = User::where('provider_id', $getInfo->id)->first();
        
        if (!$user) {
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'avatar'   => $getInfo->avatar,
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'status' => 1
            ]);
        }
        return $user;
    }
    
}
