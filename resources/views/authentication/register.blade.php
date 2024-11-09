@extends('layouts.layout')
@section('title', 'register')
@section('csss')
<style>
    form{
    border: 1px solid black;
    border-radius: 35px;
    background-color: #dfdfdf;
    border: none;
}
.btn{
    margin-top: 20px;
    width: 80%;
    height: 45px;
    background: #222;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    transition: .3s;
    color: #fff;
}
.btn:hover{
    transform: scale(1.05,1);
    background: #222;
    color: #fff;
}
.form-control{
    width: 100%;
    height: 50px;
    font-size: 17px;
    padding: 0 25px;
    margin-bottom: 15px;
    border-radius: 30px;
    border: none;
    box-shadow: 0px 5px 10px 1px rgba(0, 0, 0, 0.05);
    outline: none;
    transition: .3s;
}
</style>
@endsection
@section('content')
<div class="container-fluid mt-5 pt-5 d-flex justify-content-center align-items-center vh-100">
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
    <form action="{{route('registration.post')}}" method="post" class="mx-auto col-12 col-sm-8 col-md-6 col-lg-4 p-5">
    @csrf     
        <h3 class="text-center pb-5">Create Account</h3>

        <!-- Email Field -->
        <div class="form-group mb-3">
            <input type="email" class="form-control custom-input" id="email1" name="email" placeholder="Email" aria-describedby="emailHelp" required>
        </div>

        <!-- name Field -->
        <div class="form-group mb-3">
            <input type="text" class="form-control custom-input" id="uName" name="name" placeholder="name" required>
        </div>

        <!-- Password Field -->
        <div class="form-group mb-3">
            <input type="password" class="form-control custom-input" id="password1" name="password" placeholder="Password" required>
        </div>
        
        <div class="form-group mb-3">
            <input type="password" class="form-control custom-input" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn">
                Sign Up
            </button>
        </div>
    </form>
</div>

@endsection