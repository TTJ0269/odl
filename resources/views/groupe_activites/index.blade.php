@extends('layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Groupe d'activité</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Groupe d'activité</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <a href="{{ route('groupe_activites.create') }}" class="btn btn-primary my-3"><i class="fas fa-plus-circle"></i><span> Nouveau </span></a>

    <!-- cadre general -->
    <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Liste des groupes d'activités</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="user" class="nav-icon fas fa-bookmark"></span>
    </div>
  </div>
  <!-- /fin cadre -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-body">
                               <table id="example1" class="table table-bordered table-striped">
                                  <hr>
                                <thead>
                                    <th scope="col">Numero</th>
                                    <th scope="col">Identifiant</th>
                                    <th scope="col">Libelle</th>
                                    <th scope="col">Metier</th>
                                </thead>

                                    <tbody>
                                    @foreach($groupe_activites as $key=>$groupe_activite)
                                    <tr>
                                    <th scope="row"> {{++$key}} </th>
                                    <th scope="row"> {{$groupe_activite->identifiantgroupe}} </th>
                                    <td> <a href="{{ route('groupe_activites.show', ['groupe_activite' => $groupe_activite->id]) }}" style="color:rgb(55, 144, 246);"> {{$groupe_activite->libellegroupe}} </a></td>
                                    <th scope="row"> {{$groupe_activite->metier->libellemetier}} </th>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                     </div>
                </div>
            </div>
         </div>
     </div>
@endsection
