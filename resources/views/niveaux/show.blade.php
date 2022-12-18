@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Niveau</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Niveau</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  <!-- cadre general -->
<div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Niveau</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="classe" class="nav-icon fas fa-sort-amount-up-alt"></span>
    </div>
  </div>
  <!-- /fin cadre -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-body">
                            <a href="{{ route('niveaux.edit', ['niveau' => $niveau->id]) }}" class="btn btn-primary my-3"><i class="fas fa-edit"></i><span> Modifier </span></a>
                            <form action="{{ route('niveaux.destroy', ['niveau' => $niveau->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Vous allez effectuer une suppression')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i><span> Supprimer </span></button>
                            </form>
                            <hr>
                            <p><strong>Libelle :</strong> {{$niveau->libelleniveau}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
