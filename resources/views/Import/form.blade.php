@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Importation</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Importation</li>
            </ol>
           </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>

    <div class="row">
    <div class="col-12 col-sm-6">
        @include('Import.form.user_ifad')
    </div>
    <div class="col-12 col-sm-6">
        @include('Import.form.activite_tache')
    </div>
    </div>

    @if (session()->has('messageerreur'))
    <h6 style="color:red"> Erreur </h6>
    <div class="btn btn-danger btn-block" role="alert">
        {{ session()->get('messageerreur') }}
        @if ($errors->any())
        <h6 style="color:red"> Erreur dans le fichier Excel</h6>
        <ol>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ol>
        @endif
    </div>
    @endif

@endsection
