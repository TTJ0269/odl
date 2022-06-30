@extends('layouts.app')

@section('content')

<h2> vrai vrai </h2>

@endsection


@extends('layouts.appwelcome')

@section('content')

<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>Admin</b>LTE</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Bienvenue, sur la page de connection. Pour accéder à la plateforme veuillez vous connecter</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
          <!-- Email Address -->

          <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" :value="old('email')" placeholder="Email" required autofocus />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

        <!-- Password -->

        <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" class="block mt-1 w-full" name="password" placeholder="Password"  required autocomplete="current-password" />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
            </div>
          </div>
        </form>

        <p class="mb-1 my-2">
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
        @endif
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  @endsection
