<?php

namespace App\Http\Controllers\Intranet;

use App\Http\Controllers\Controller;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function signInwithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackToGoogle()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('gauth_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect('/');
            } else {
                $findEmail = User::where('email', $user->email)->first();

                if ($findEmail) {

                    $findEmail->gauth_id = $user->id;
                    $findEmail->gauth_type = 'google';
                    $findEmail->save();

                    Auth::login($findEmail);
                    return redirect('/');
                }
            }
            //else{
            //     $newUser = User::create([
            //         'name' => $user->name,
            //         'email' => $user->email,
            //         'gauth_id'=> $user->id,
            //         'gauth_type'=> 'google',
            //         'password' => encrypt('admin@123')
            //     ]);

            //     Auth::login($newUser);

            //     return redirect('/dashboard');
            // }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
