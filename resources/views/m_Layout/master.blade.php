<!DOCTYPE html>
<html lang="en">
<head>
  <title>Tourist Assist</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src='https://api.mapbox.com/mapbox-gl-js/v1.2.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.2.0/mapbox-gl.css' rel='stylesheet' />
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="{{url('/')}}">HOME</a>
  <!-- Links -->

<ul  class="navbar-nav ml-auto">
  @if(Gate::check('isAuthor')||Gate::check('isAdmin'))
  <li  class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
      Tour
    </a>
     <div class="dropdown-menu">
      <a class="dropdown-item" href="{{route('tour.index')}}">@csrf @method('get')Tours</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="{{route('tour.create')}}">Create a Tour</a>
      <!-- <a class="dropdown-item" href="/tour/{{Auth::user()->id}}">My Tours</a> -->
      </div>
  </li>
  @endif
 @if(Gate::check('isAdmin'))
<li  class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
      Category
    </a>
     <div class="dropdown-menu">
      <a class="dropdown-item" href="{{route('category.index')}}">@csrf @method('get') 
      Category</a>
      <div class="dropdown-divider"></div>
      <!-- user can't create tour -->
      <a class="dropdown-item" href="{{route('category.create')}}">@csrf @method('get') Create a Category</a>
       
 
      </div>
</li>
@endif
@if(Gate::check('isAuthor')||Gate::check('isAdmin'))
<li  class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
      Hotels
    </a>
     <div class="dropdown-menu">
      <a class="dropdown-item" href="{{route('hotel.index')}}">@csrf @method('get')Hotel</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="{{route('hotel.create')}}">
      @csrf @method('get') Create a Hotel</a>
      <!-- <a class="dropdown-item" href="/user/{{Auth::user()->id}}">My Hotels</a> -->
      </div>
</li>
@endif
@if(Gate::check('isAdmin'))
<li class="nav-item">
    <a class="nav-link" href="/listofuser" >List of User</a>
</li>
@endif
<li  class="nav-item dropdown">
  @if (Route::has('login'))
  @auth
  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"
  style="color: white;">
        Hi,{{ Auth::user()->name }}({{Auth::user()->user_role}})
      </a>
      <div class="dropdown-menu">

        <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();"
        >{{ __('Logout') }}
        </a>
      
      </div>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
   @csrf
  </form>
   @else
   <a href="{{ route('login') }}" class="btn btn-info" role="button">Login</a>
   <a href="{{ route('register') }}" class="btn btn-info" role="button">Register</a>
    @endauth
          
  @endif
  </li>
</ul>

</nav>
<br>

<div class="container">
  @yield('body')
  
</div>

</body>
</html>
