@extends('layouts.navigation')
@section('login_section')
<h1>Sei già membro? Effettua il login o registrati!</h1>
<div class="login__registration__wrapper">
  <a href="{{ url('loginpage') }}">Login</a>
  <a href="{{ url('registractionpage') }}">Registrati</a>
</div>
@endsection