@extends('layouts.apptemple')

@section('content')
<div class="about_section layout_padding">
    <div class="container">
        <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
            <a href="#" class="h1"><b>AED</b></a>
            </div>
            <div class="card-body">
            <p class="login-box-msg">Vous venez de faire une demande d’un nouveau mot de passe. Apres avoir consulté votre boite mail, veuillez-vous connecter</p>
            <p class="text-center">
                <a href="{{ route('login') }}"> Se Connecter</a>
            </p>
            </div>
            <!-- /.login-card-body -->
        </div>
        </div>
        <!-- /.login-box -->
  </div>
</div>

@endsection
