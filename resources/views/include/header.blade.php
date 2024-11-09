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
            <a class="nav-link active" aria-current="page" href="#">Home</a>
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
          <li class="nav-item mx-2 pt-2">
              @auth
              <span class="text-white">{{ auth()->user()->name }} </span>
              @endauth
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link text-danger" href="{{route('logout')}}">Log out</a>
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