@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Mail</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Mail</li>
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
          <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Mail non envoyé.</h3>

          <p>
             Enregistrement effectué avec succès mais le mail n'a pu être envoyé à l'utilisateur ou entreprise concerné(e).
             <a href="#">Cela peut être dû au mauvais renseignement du mail ou le mail n'existe pas</a>
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
