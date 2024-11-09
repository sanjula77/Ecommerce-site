@extends('layouts.layout')
@section('title', 'login')
@section('csss')
<style>
        @media (max-width: 991px) {
    .offcanvas.sidebar {
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
    }
}

form{
    border: 1px solid black;
    border-radius: 35px;
    background-color: #dfdfdf;
    border: none;
}
.btn{
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
.divide-content-center{
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    background-color:#dfdfdf;
    font-size: 0.8rem;
    font-weight: 500;
    color: dark;
    padding-bottom: 5px;
}

.imag{
    width: 35px;
    height: 35px;
    margin-right: 1rem;
}
.aple{
    width: 35px;
    height: 35px;
    margin-left: 1rem;
}
    </style>
@endsection
@section('content')
 <div class="container-fluid mt-5 pt-5 d-flex justify-content-center align-items-center vh-100">
 <div class="mt-5">
        @if($errors->any())
          <div class="col-12">
              @foreach($errors->all() as $error)
                <div class="alert" alert-danger>
                  {{$error}}
                </div>           
              @endforeach
          </div>
        @endif

        @if(session()->has('error'))
          <div class="alert" alert-danger>
             {{session('error')}}
          </div> 
        @endif

        @if(session()->has('success'))
          <div class="alert" alert-success>
             {{session('success')}}
          </div> 
        @endif
    </div>
        <form action="{{route('login.post')}}" method="POST" class="mx-auto col-12 col-sm-8 col-md-6 col-lg-4 p-5">
        @csrf    
            <h3 class="text-center pb-5">Login</h3>

            <!-- Email and Password Login -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <input type="email" class="form-control" id="email1" name="email" placeholder="Email">
                </div>
            </div>

            <div class="mb-3">
                <input type="password" class="form-control" id="password1" name="password" placeholder="Password">
                <div id="forgot" class="form-text">Forgot password?</div>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn">Login</button>
            </div>

            <div class="text-center mt-3">
                <p>Don't have an account? <a href="signUp.php">Sign Up</a></p>
            </div>

            <!-- Divider and Google Sign-In -->
            <div class="position-relative">
                <hr class="text-secondary">
                <div class="text-center">or</div>
            </div>
            <div class="text-center pt-2">
                <p>Continue with</p>
            </div>
           

            <!-- Google Image Button (Add your custom icon here) -->
            <div class="text-center mt-3">
                <a href="loginWithGoogle.php"><img class="imag" src="icons8-google.svg" alt="Google"></a>
            </div>

        </form>
    </div>

@endsection