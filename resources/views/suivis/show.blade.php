@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">PFMP</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">PFMP</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  <!-- cadre general -->
<div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">PFMP (Période de Formation en Milieu Professionnel)</h3>
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
                        <br>
                            <a href="{{ route('suivi_fin', ['suivi' => $suivi->id]) }}" class="btn btn-warning"><i class="fas fa-edit"></i><span> Fin du suivi </span></a>
                            <form action="{{ route('suivis.destroy', ['suivi' => $suivi->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Vous allez effectuer une suppression')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i><span> Supprimer </span></button>
                            </form>
                            <hr>
                            <p><strong>Apprenant(e) :</strong> {{$suivi->user->nomuser}} {{$suivi->user->prenomuser}}</p>
                            @if($suivi->datedebut)
                            <p><strong>Date début :</strong> {{$suivi->datedebut}}</p>
                            @else
                            <p><strong>Date début :</strong> Pas définie</p>
                            @endif
                            @if($suivi->datefin)
                            <p><strong>Date fin :</strong> {{$suivi->datefin}}</p>
                            @else
                            <p><strong>Date fin :</strong> Pas définie</p>
                            @endif
                            <p><strong>Nom Entreprise :</strong> {{$suivi->entreprise->libelleentreprise}}</p>
                            <p><strong>Tél Entreprise :</strong> {{$suivi->entreprise->telentreprise}}</p>
                            <p><strong>Email Entreprise :</strong> {{$suivi->entreprise->emailentreprise}}</p>
                            <p><strong>Adresse Entreprise :</strong> {{$suivi->entreprise->adresseentreprise}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
