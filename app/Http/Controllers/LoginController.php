<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
         ]);
        
         $user = User::where('email', $request->email)->first();
        
         if(!$user || !Hash::check($request->password, $user->password)) {

            throw ValidationException::withMessages([
                'email' => ['the credentials not found']
            ]);
        }
        return $user->createToken('Auth Token')->accessToken;
       
    }
}
