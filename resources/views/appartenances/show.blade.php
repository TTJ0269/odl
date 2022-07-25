@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tuteur/Tutrice</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Tuteur/Tutrice</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <!-- cadre general -->
<div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h4 class="card-title">Liste des tuteurs</h4>
    <div class="card-tools">
      <span data-toggle="tooltip" title="user" class="nav-icon fas fa-paste"></span>
    </div>
  </div>
  <!-- /fin cadre -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-body">
                        <a href="{{ route('appartenances.edit', ['appartenance' => $appartenance->id]) }}" class="btn btn-primary my-3"><i class="fas fa-edit"></i><span> Modifier </span></a>
                        <form action="{{ route('appartenances.destroy', ['appartenance' => $appartenance->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"  class="btn btn-danger delete"><i class="fas fa-trash"></i><span> Supprimer </span></button>
                        </form>
                          <hr>
                        <p><strong>Nom :</strong> {{$appartenance->user->nomuser}}</p>
                        <p><strong>Prenom :</strong> {{$appartenance->user->prenomuser}}</p>
                        <p><strong>Email :</strong> {{$appartenance->user->email}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
