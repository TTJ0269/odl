@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Erreur</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Erreur</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

 <section class="content">
      <div class="error-page">
        <h2 class="headline text-danger">500</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Quelque chose s'est mal passé.</h3>

          <p>
            Nous allons travailler à corriger cela tout de suite.
           Si le problème persiste <a href="#">Veuillez contacter l'administrateur pour plus de détails merci.</a>
          </p>

          <p>
            @if (session()->has('messageerreur'))
            <div class="btn btn-danger btn-block" role="alert">
            {{ session()->get('messageerreur') }}
            </div>
            @endif
          <p>

        </div>
      </div>
      <!-- /.error-page -->

    </section>
@endsection
