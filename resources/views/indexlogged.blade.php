@extends('layouts.navigation')
@section('login_section')
<h1> Benvenuto {{ $username }}!</h1>
<a href="{{ url('Profile') }}"> <img src="images/profile-user.png" id="profile__image" alt=""> </a>
<div class="login__registration__wrapper">
  <a href="{{ url('logout') }}">Logout</a>
</div>
@endsection
