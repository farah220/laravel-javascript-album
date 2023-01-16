<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate(
         [ 'email' => ['required','email','max:255','exists:users'],
           'password' => ['required','min:8','max:255']

         ]);
        if(!auth('web')->attempt($credentials))
            throw ValidationException::withMessages(['password' => 'invalid password']);

    }
    public function register(Request $request){
        $credentials = $request->validate(
            [   'name' => ['required','max:255'],
                'email' => ['required','email','max:255','unique:users'],
                'password' => ['required','min:8','max:255','confirmed'],
                'password_confirmation' => ['required','min:6','max:255','same:password']

            ]);
        $user = User::create($credentials);
        auth('web')->login($user);
       

    }
    public function logout(User $user){
       Auth::guard('web')->logout();
        return redirect()->route('web.login-form');

    }
}
