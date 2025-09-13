<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GoogleWithOAuthController extends Controller
{
    public function googleLogin(){
        return Socialite::driver('google')->redirect();
    }

    public function googleHandle(){
        try{
            $user = Socialite::driver('google')->user();
            $findUser = User::where('email',$user->email)->first();

            if(!$findUser){
                $findUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => Hash::make('123'),
                ]);
            }

            session()->put('user', $findUser);
            return redirect()->route('home');
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }
}
