<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signupShow(){
        return view('auth.signup');
    }

    public function signup(Request $request){
        $userData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $userData['password'] = Hash::make($userData['password']);

        User::create($userData);
        auth()->attempt($request->only('email', 'password'), $request->has('remember'));
        return redirect()->route('web.task.index')->with('message', 'Signup Successful!');
    }


    public function loginShow(){
        return view('auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        if(auth()->attempt($request->only('email', 'password'), $request->has('remember'))){
            return redirect()->route('web.task.index')->with('message', 'Welcome Back!');
        }else{
            return redirect()->route('web.user.login')->with('message', 'Wrong Credentials');
        }
    }


    public function logout(){
        auth()->logout();
        return redirect()->route('web.user.login');
    }
}
