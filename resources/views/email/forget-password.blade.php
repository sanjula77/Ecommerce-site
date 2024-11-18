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
        width:100px;
    }
    .btn-save:hover {
        background-color: #3a2f29;
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
    
    <a href="{{route('reset.password', $token)}}">Reset password</a>
    
</div>

@endsection