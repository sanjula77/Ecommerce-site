<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


class authController extends Controller
{
    function login(){
        return view('authentication.login');
    }
    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:8'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended('home');
        }
        return redirect(route('login'))->with("error", "Login failed");
    }

    function registration(){
        return view('authentication.register');
    }

    function registrationPost(Request $request){
        $request->validate([
            'name' =>'required',
            'email' =>'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);
        
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data); 
        if(!$user){
            return redirect(route('register'))->with("error", "Registration failed");
        }
        return redirect(route('login'))->with("success", "Successfully registered");
    }
    function logout() {
        Session::flash();
        Auth::logout();
        return redirect()->route('login');  // Redirect to login page after logout.
    }
}
