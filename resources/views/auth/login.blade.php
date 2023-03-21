@extends('layouts.apptemple')

@section('content')
    <!-- about section start -->
    <div class="about_section layout_padding">
        <div class="container">
            <div class="text-center">
                <h6 style="font-size: 200%; color:rgb(13, 50, 150)">Bienvenue dans l'outil de liaison de l'{{$name}}</h6>
            </div>
            <br>
          <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-5">
                <img src="{{ asset('bb/images/'.$logo) }}" style="width: 100%;"/>
            </div>
            <div class="col-md-4" style="background-color: rgba(222, 226, 227, 0.8);border: 1px solid rgb(138, 144, 141);">

                <form method="POST" action="{{ route('login') }}" class="info">
                    <br>
                    @csrf
                    <div class="text-center">
                        <h1 class="login-box-msg">Connectez-vous</h1>
                    </div>
                    <div class="form-group mt-1">
                        <h2>Login</h2>
                        <input type="text" class="form-control" name="email" :value="old('email')" placeholder="Login ou Email" required autofocus />
                    </div>
                    <div class="form-group mt-1">
                        <h2>Mot de passe</h2>
                        <input type="password" class="form-control" id="password" class="block mt-1 w-full" name="password" placeholder="Mot de passe"  required autocomplete="current-password" />
                    </div>
                    <div class="text-center my-1">
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </div>
                </form>

                <div class="d-flex justify-content-end">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié?') }}
                    </a>
                    @endif
                </div>
            </div>
            <div class="col-md-1">
            </div>

          </div>

          <div class="my-2" style="float:right; margin-right: 170px">
            <i style="color: rgb(9, 121, 40)">Besoin d'aide, cliquer ici</i>
            <a href="{{ route('aide_index') }}"><img src="{{ asset('bb/images/aide.png') }}" style="height: 35px; width: 35px;" alt=""></a>
          </div>
        </div>
      </div>


      <!-- about section end -->
@endsection
