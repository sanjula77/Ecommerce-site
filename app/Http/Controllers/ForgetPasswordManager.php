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
        $request->validate([
            'email' => "required|email|exists:users",
        ]);

        // Delete any existing tokens for this email
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        try {
            Mail::send("email.forget-password", ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password');
            });
        } catch (\Exception $e) {
            return redirect()->route('forget.password')
                ->with('error', 'Failed to send email. Please try again later.');
        }

        return redirect()->route('forget.password')
            ->with('success', 'We have sent a password reset link to your email address.');
    }
    function resetPassword($token){
        $tokenRecord = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->first();

        if (!$tokenRecord) {
            return redirect()->route('forget.password')
                ->with('error', 'Invalid or expired reset token.');
        }

        // Check if token is older than 1 hour
        if (now()->diffInHours($tokenRecord->created_at) > 1) {
            DB::table('password_reset_tokens')->where('token', $token)->delete();
            return redirect()->route('forget.password')
                ->with('error', 'Reset token has expired. Please request a new one.');
        }

        return view("email.new-password", compact('token'));
    }

    //reset password
    function resetPasswordPost(Request $request){
        $request->validate([
            'email' => "required|email|exists:users",
            'password' => "required|string|min:8|confirmed",
            'token' => "required|string",
        ]);
        
        $updatePassword = DB::table("password_reset_tokens")
            ->where([
                "email" => $request->email,
                "token" => $request->token
            ])->first();

        if(!$updatePassword){
            return redirect()->route("reset.password", ['token' => $request->token])
                ->with("error", "Invalid or expired reset token.");
        }

        // Check if token is older than 1 hour
        if (now()->diffInHours($updatePassword->created_at) > 1) {
            DB::table("password_reset_tokens")->where(["email" => $request->email])->delete();
            return redirect()->route('forget.password')
                ->with('error', 'Reset token has expired. Please request a new one.');
        }

        User::where("email", $request->email)
            ->update(["password" => Hash::make($request->password)]);

        DB::table("password_reset_tokens")->where(["email" => $request->email])->delete();
        
        return redirect()->route("login")
            ->with("success", "Password reset successfully. Please login with your new password.");
    }
}