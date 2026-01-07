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
        if(Auth::check()){
            return redirect(route('home'));
        }
        return view('authentication.login');
    }
    function loginPost(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials, $request->filled('remember'))){
            $request->session()->regenerate();
            return redirect(route('products'))->with('success', 'Welcome back!');
        }
        return redirect(route('login'))->with("error", "Invalid email or password");
    }

    function registration(){
        if(Auth::check()){
            return redirect(route('home'));
        }
        return view('authentication.register');
    }

    function registrationPost(Request $request){
        $request->validate([
            'name' =>'required',
            'username' => 'required|max:12',
            'email' =>'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);
        
        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data); 
        if(!$user){
            return redirect(route('register'))->with("error", "Registration failed");
        }
        return redirect(route('login'))->with("success", "Successfully registered");
    }
    function logout() {
        Session::flash('success', 'You have successfully logged out.');
        Auth::logout();
        return redirect()->route('login'); 
    }

    function profile(){
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('authentication.user_profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'username' => 'nullable|string|max:12|unique:users,username,' . Auth::id(),
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'mobile' => 'nullable|string|max:15',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        $user->name = $request->input('full_name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');

        
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('profile_pictures', $fileName, 'public');

            // Store the file path in the database
            $user->profile_picture = $filePath;
        }

        $user->save();

        
        return redirect()->route('profile');
    }


}
