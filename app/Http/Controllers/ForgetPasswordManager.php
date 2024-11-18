<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ForgetPasswordManager extends Controller
{
    function forgetpassword(){
        return view("authentication.forget-password");
    }

    function forgetpasswordPost(Request $request){
        $request -> validate([
            'email' => "required|email|exists:users",
        ]);

        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([[
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]]);

        Mail::send("email.forget-password", ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
    });
    return redirect()->route('forget-Password')->with('success', 'We have sent a password reset link to your email address.');
}
function resetPassword($token){
    return view("email.new-password", compact('token'));
}
//reset password
function resetPasswordPost(Request $request){
    $request->validate([
        'email' => "required|email|exists:users",
        'password' => "required|string|min:6|confirmed",
        'password_confirmation' => "required", 
    ]);
    
    $updatePassword = DB::table("password_reset_tokens")
    -> where([
        "email" => $request->email,
        "token" => $request->token
    ])->first();

    if(!$updatePassword){
        return redirect()->to(route("reset.password"))-> with("error", "Invalid");
    }

    User::where("email", $request->email)
    ->update(["password" => Hash::make($request->password)]);

    DB::table("password_reset_tokens")->where(["email" => $request->email])->delete();
    return redirect()->to(route("login"))-> with("success", "password reset success");
}
}