@extends('layouts.layout')
@section('title', 'Profile')
@section('csss')
<style>
    .profile-card {
        max-width: 600px;
        margin: auto;
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
        border-radius: 5px;
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
        @if (auth()->user()->profile_picture)
    <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Picture" class="img-thumbnail">
@else
    <img src="https://via.placeholder.com/150" alt="Default Profile Picture" class="img-thumbnail">
@endif

        <h2>{{ auth()->user()->name }}</h2>
        
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 text-start">
                <label for="fullName" class="form-label">Full Name:</label>
                <input type="text" class="form-control" id="fullName" name="full_name" value="{{ auth()->user()->name }}">
            </div>
            <div class="mb-3 text-start">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ auth()->user()->username }}">
            </div>
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}">
            </div>
            <div class="mb-3 text-start">
                <label for="mobile" class="form-label">Mobile:</label>
                <input type="text" class="form-control" id="mobile" name="mobile" value="{{ auth()->user()->mobile }}">
            </div>
            <div class="mb-3 text-start">
                <label for="profilePicture" class="form-label">Update DP:</label>
                <input type="file" class="form-control" id="profilePicture" name="profile_picture">
            </div>
            <button type="submit" class="btn btn-save">Save Changes</button>
        </form>
    </div>

@endsection
