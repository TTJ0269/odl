@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Fiche de positionnement</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Fiche de positionnement</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <a href="javascript:history.back();" class="btn btn-primary my-2"><i class="fas fa-angle-left"></i> Retour</a>

<div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Fiche de positionnement générale </h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="user" class="nav-icon fas fa-book-open"></span>
    </div>
  </div>
  <!-- /fin cadre -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-body">

                            <table id="#" class="table table-bordered table-striped">
                                  <hr>
                                <thead>
                                    <th scope="col">Numéro</th>
                                    <th scope="col">Fonctions</th>
                                    <th scope="col">Activités, Tâches & positionnements</th>
                                </thead>

                                    <tbody>
                                        @foreach($collections as $key=>$collection)
                                    <tr>
                                    <th scope="row"> {{ 1+ $key++}} </th>
                                    <th scope="row"> {{$collection['focntion_libelle']}}</th>
                                    <th scope="row">
                                            <table id="#" class="table table-bordered table-hover">
                                              <thead>
                                                  <th scope="col" style="color:rgb(55, 144, 246);" class="col-12 col-sm-3">Activités </th>
                                                  <th scope="col" style="color:rgb(55, 144, 246);" class="col-12 col-sm-9">Tâches et positionnements </th>
                                              </thead>

                                              <tbody>
                                                @foreach($collection['activites'] as $activite)
                                                  <tr>
                                                    <th scope="row"> {{$activite['activite_libelle']}} </th>
                                                    <th scope="row">

                                                        <table id="#" class="table table-bordered table-hover">
                                                            <thead>
                                                                <th scope="col" style="color:rgb(55, 144, 246);" class="col-12 col-sm-10">Tâches </th>
                                                                <th scope="col" style="color:rgb(55, 144, 246);" class="col-12 col-sm-2">Position </th>
                                                            </thead>

                                                            <tbody>
                                                                @foreach($activite['taches'] as $tache)
                                                                <tr>
                                                                  <th scope="row"> {{$tache->libelletache}} </th>
                                                                  <th scope="row"> {{$tache->valeurpost}} </th>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                         </table>

                                                    </th>
                                                  </tr>
                                                  @endforeach
                                              </tbody>
                                           </table>
                                    </th>
                                    </tr>
                                    @endforeach
                                    </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <div class="row no-print">

          <div class="col-12">
            <a href="{{ route('statistique_generale', ['user' => $user->id]) }}" class="btn btn-primary"> <i class="fas fa-chart-line"></i><span> Radars de positionement générale </span> </a>
            <button onclick="window.print()" class="btn btn-success my-2"><i class="far fa-credit-card"></i> Imprimer</button>
          </div>
      </div>

@endsection
