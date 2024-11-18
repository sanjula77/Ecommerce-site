@extends('layouts.layout')
@section('title', 'Password Reset')
@section('csss')  
<style>
    .profile-card {
        margin-top:200px;
        max-width: 600px;
        margin-left:auto;
        margin-right:auto;
        background: #f9f9f9;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    .profile-card img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin-bottom: 15px;
        border: 3px solid #ddd;
    }
    .profile-card h2 {
        font-size: 24px;
        margin-bottom: 20px;
    }
    .form-label {
        font-weight: bold;
        padding-left: 55px
    }
    .btn-save {
        background-color: #4a3f35;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 20px;
        width:200px;
    }
    .btn-save:hover {
        background-color: #3a2f29;
        color: #f9f9f9
    }
    .profile-card .form-control {
        width: 80%; 
        margin: auto; 
        font-size: 14px; 
    }
</style>
@endsection

@section('content')
<div class="profile-card">  
    <div class="mt-5">
        @if($errors->any())
          <div class="col-12">
              @foreach($errors->all() as $error)
                <div class="alert alert-danger" >
                  {{$error}}
                </div>           
              @endforeach
          </div>
        @endif

        @if(session()->has('error'))
          <div class="alert alert-danger">
             {{session('error')}}
          </div> 
        @endif

        @if(session()->has('success'))
          <div class="alert alert-success">
             {{session('success')}}
          </div> 
        @endif
    </div>
    
    <p> We will send a link to your email, Use that link to reset password</p>
    <form action="{{ route('reset-Password-post') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        
        <div class="mb-3 text-start">
            <label for="email" class="form-label">Email:</label>
            <input type="email"class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3 text-start">
            <label for="password" class="form-label">New Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3 text-start">
            <label for="password_confirmation" class="form-label">Confirm Password:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        
        <button type="submit" class="btn btn-save">Reset Password</button>
    </form>
</div>
@endsection
