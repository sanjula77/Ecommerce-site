<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
class ForgetPasswordManager extends Controller
{
    function forgetpassword(){
        return view("authentication.forget-password");
    }

    function forgetpasswordPost(Request $request){
        $request -> validate([
            'email' => "required|email|exists: users",
        ]);

        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([[
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]]);

        Mail::send("email.forgetpassword", ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
    });
    return redirect()->route('forget-Password')->with('success', 'We have sent a password reset link to your email address.');
     
    function resetPassword($token){
        $resetToken = DB::table('password_reset_tokens')->where('token', $token)->first();
        if(!$resetToken || $resetToken->created_at->addMinutes(15) < now()){
            return redirect()->route('forgetpassword')->with('error', 'Token expired or invalid');
        }

        return view("authentication.reset-password", compact('token'));
    }

}
