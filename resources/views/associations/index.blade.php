@extends('layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Association</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Association</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <a href="{{ route('associations.create') }}" class="btn btn-primary my-3"><i class="fas fa-plus-circle"></i><span> Nouvelle association </span></a>
    <a href="{{ route('association_datefin_create') }}" class="btn btn-secondary my-3"><i class="fas fa-minus-circle"></i><span> Fin association </span></a>



    <!-- cadre general -->
<div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Liste des associations</h3>
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
                                <table id="example1" class="table table-bordered table-striped">
                                  <hr>
                                <thead>
                                    <th scope="col">Numero</th>
                                    <th scope="col">Utilisateur</th>
                                    <th scope="col">IFAD</th>
                                    <th scope="col">Début activité</th>
                                    <th scope="col">Fin activité</th>
                                    <th scope="col">Classe</th>
                                    @can('admin','App\Models\User')
                                    <th scope="col">Action</th>
                                    @endcan
                                    <th scope="col">Profil</th>
                                </thead>

                                    <tbody>
                                    @foreach($associations as $key=>$association)
                                    <tr>
                                    <th scope="row"> {{++$key}} </th>
                                    <td> <a href="{{ route('associations.show', ['association' => $association->id]) }}" style="color:rgb(55, 144, 246);"> {{$association->user->nomuser}} {{$association->user->prenomuser}} </a></td>
                                    <th scope="row"> {{$association->classe->metier->ifad->libelleifad}}  </th>
                                    <th scope="row"> {{$association->datedebut}} </th>
                                    <th scope="row"> {{$association->datefin}} </th>
                                    <th scope="row"> {{$association->classe->libelleclasse}} </th>
                                    @can('admin','App\Models\User')
                                    <th scope="row">
                                    <form action="{{ route('associations.destroy', ['association' => $association->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Vous allez effectuer une suppression')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i><span> Supprimer </span></button>
                                    </form>
                                    </th>
                                    @endcan
                                    <th scope="col">{{$association->user->profil->libelleprofil}}</th>
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
