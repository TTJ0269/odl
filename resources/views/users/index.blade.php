@extends('layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Utilisateur</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Utilisateur</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <a href="{{ route('users.create') }}" class="btn btn-primary my-3"><i class="fas fa-plus-circle"></i><span> Nouveau utilisateur </span></a>

    <!-- cadre general -->
<div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Liste des utilisateurs</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="user" class="nav-icon fas fa-user"></span>
    </div>
  </div>
  <!-- /fin cadre -->

  @can('admin','App\Models\User')
  <div class="row">
     <div class="col-12">
        <a href="{{ route('import_user_index')}}" class="btn btn-success float-left"><i class="fas fa-folder-open"></i> Import Excel</a>
        <a href="{{ route('export_user')}}" class="btn btn-success float-right"><i class="fas fa-folder-open"></i> Export Excel</a>
        <a href="{{ route('export_user_cvs')}}" class="btn btn-success float-right"><i class="fas fa-folder-open"></i> Export CVS</a>
     </div>
 </div>
  @endcan

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
                                    <th scope="col">Login</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Téléphone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Profil</th>
                                </thead>

                                    <tbody>
                                    @foreach($users as $key=>$user)
                                    <tr>
                                    <th scope="row"> {{++$key}} </th>
                                    <td> <a href="{{ route('users.show', ['user' => $user->id]) }}" style="color:rgb(55, 144, 246);"> {{$user->name}} </a> </td>
                                    <th scope="row"> {{$user->nomuser}} {{$user->prenomuser}} </th>
                                    @if($user->teluser)
                                    <th scope="row"> {{$user->teluser}} </th>
                                    @else
                                    <th scope="row"> -- Aucune valeur trouvée -- </th>
                                    @endif
                                    @if($user->email)
                                    <th scope="row"> {{$user->email}} </th>
                                    @else
                                    <th scope="row"> -- Aucune valeur trouvée -- </th>
                                    @endif
                                    <th scope="row"> {{$user->profil->libelleprofil}} </th>
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
