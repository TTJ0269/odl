@extends('layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Rattachement</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Rattachement</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <a href="{{ route('rattachers.create') }}" class="btn btn-primary my-3"><i class="fas fa-plus-circle"></i><span> Nouveau </span></a>



    <!-- cadre general -->
<div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Liste des rattachements</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="user" class="nav-icon fas fa-expand"></span>
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
                                    <th scope="col">Métier</th>
                                    <th scope="col">IFAD</th>
                                    <th scope="col">Début activité</th>
                                    <th scope="col">Fin activité</th>
                                    <th scope="col">Profil</th>
                                </thead>

                                    <tbody>
                                    @foreach($rattachers as $key=>$rattacher)
                                    <tr>
                                    <th scope="row"> {{++$key}} </th>
                                    <td> <a href="{{ route('rattachers.show', ['rattacher' => $rattacher->id]) }}" style="color:rgb(55, 144, 246);"> {{$rattacher->user->nomuser}} {{$rattacher->user->prenomuser}} </a></td>
                                    <th scope="row"> {{$rattacher->metier->libellemetier}}  </th>
                                    <th scope="row"> {{$rattacher->ifad->libelleifad}}  </th>
                                    <th scope="row"> {{$rattacher->datedebut}} </th>
                                    <th scope="row"> {{$rattacher->datefin}} </th>
                                    <th scope="col">{{$rattacher->user->profil->libelleprofil}}</th>
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
