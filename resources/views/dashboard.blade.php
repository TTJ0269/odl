@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item" style="font-size: 70%"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active" style="font-size: 70%">Bienvenue</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
  <div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 col-sm-1">
            </div>
            <div class="col-12 col-sm-10">
                <div class="text-center" style = "font-family: 'Berlin Sans FB';">
                    <h3 style="color:#7D0ABEF;"> <strong> OUTIL DE LIAISON </strong></h3>
                </div>
            </div>
            <div class="col-12 col-sm-1">
                <img class="profile-user-img img-fluid" src="{{ asset('storage/image/' .Auth::user()->imageuser) }}" style="height:70px; width:70px;" alt="profile picture">
                <h6 style="font-size: 90%">{{ Auth::user()->nomuser }} {{ Auth::user()->prenomuser }}</h6>
            </div>
        </div>
        <h6>  En tant que <B> {{ Auth::user()->profil->libelleprofil }} </B> vous pouvez :</h6>

            <div class="timeline timeline-inverse">
                <!-- timeline time label -->

                   @include('acceuils.admin')
                   @include('acceuils.apprenant')
                   @include('acceuils.charge_suivi')
                   @include('acceuils.dg_ifad')
                   @include('acceuils.formateur_ifad')
                   @include('acceuils.responsable_pedagogique')
                   @include('acceuils.suivi_aed')

                 <div> <i class="fas fa-book bg-danger"></i></div>
            </div>

          <!--div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-primary"><i class="nav-icon fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Utilisateurs</span>
                <span class="info-box-number">nombres</span>
              </div>
            </div>
          </div-->

  </div>
</div>
@endsection
