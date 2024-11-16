
<style>
   

    .navbar {
        height: 100px; /* Adjust this value as needed */
    }

    .navbar-brand {
        font-size: 1.8rem; /* Adjust font size of the brand */
        line-height: 80px; /* Center vertically with the navbar height */
    }

    .navbar-nav .nav-link {
        font-size: 1.1rem; /* Adjust font size of nav links */
        padding: 15px 10px; /* Adjust padding for better spacing */
    }

    .sidebar .offcanvas-header {
        height: 80px; /* Match sidebar header height with navbar */
    }

    .sidebar .offcanvas-title {
        line-height: 80px; /* Vertically center the title */
    }



    .profile-section {
    text-align: center;
    padding-bottom: 23px
}

.profile-section .profile-car img {
    width: 40px; 
    height: 40px; /
    border-radius: 50%;
    border: 2px solid #ccc; 
    margin-bottom: 5px; 
}

.profile-section .username {
    font-size: 1rem; 
    color: white; 
    display: block; 
    font-weight: 500; 
}

.navbar-nav {
    display: flex;
    justify-content: center; 
    align-items: center;    
    margin: auto;           
    gap: 15px;              
}
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand fs-2" href="#">{{config('app.name')}}</a>
    <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="sidebar offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header text-white border-bottom">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
        <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item mx-2">
            <a class="nav-link" href="{{route('cart.view')}}">Cart</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link active" aria-current="page" href="{{route('products')}}">Home</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="#">About</a>
          </li>  
          <li class="nav-item mx-2">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="#">Contact</a>
          </li>
          @auth
          
          <li class="nav-item mx-2">
            <a class="nav-link text-danger" href="{{route('logout')}}">Log out</a>
          </li>
          <li class="nav-item mx-2 text-center">
            <a class="nav-link" href="{{route('profile')}}"> <div class="profile-car">
            <div class="profile-section">
                @auth
                <div class="profile-car">
                    @if (auth()->user()->profile_picture)
                        <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Picture">
                    @else
                        <img src="https://via.placeholder.com/150" alt="Default Profile Picture">
                    @endif
                </div>
                <span class="username">{{ auth()->user()->username }}</span>
                @endauth
            </div>
            <a>
        </li>
          @else
          <li class="nav-item mx-2">
            <a class="nav-link active" aria-current="page" href="{{route('logout')}}">Login</a>
          </li>
          @endauth
        </ul>
      </div>
    </div>
  </div>
</nav>