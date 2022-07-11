@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Apprenant(e)</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Apprenant(e)</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <!-- cadre general -->
<div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h4 class="card-title">{{$apprenant->nomuser}} {{$apprenant->prenomuser}}</h4>
    <div class="card-tools">
      <span data-toggle="tooltip" title="user" class="nav-icon fas fa-user"></span>
    </div>
  </div>
  <!-- /fin cadre -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-body">
                            <a href="{{ route('apprenants.edit', ['apprenant' => $apprenant->id]) }}" class="btn btn-primary my-3"><i class="fas fa-edit"></i><span> Modifier </span></a>
                            <form action="{{ route('apprenants.destroy', ['apprenant' => $apprenant->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"  class="btn btn-danger delete"><i class="fas fa-trash"></i><span> Supprimer </span></button>
                            </form>
                            <hr>
                            <p><strong>Nom :</strong> {{$apprenant->nomuser}}</p>
                            <p><strong>Prenom :</strong> {{$apprenant->prenomuser}}</p>
                            <p><strong>Email :</strong> {{$apprenant->email}}</p>

                            @can('admin','App\Models\User')
                            <form action="{{ route('activecompte') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="number" hidden  name="id" value="{{$apprenant->id}}">
                                <button type="submit"  class="btn btn-primary"><i class="fas fa-lock-open"></i><span> Activer compte </span></button>
                              </form>
                              <form action="{{ route('bloquercompte') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="number" hidden  name="id" value="{{$apprenant->id}}">
                                <button type="submit"  class="btn btn-danger"><i class="fas fa-lock"></i><span> Bloquer compte </span></button>
                            </form>
                            @endcan

                            <p>
                            @if($apprenant->imageuser)
                            <img src="{{ asset('storage/image/' .$apprenant->imageuser) }}" alt="user-ImageUser" class="img-thumbnail" width="400">
                            @endif
                            </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
