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

    <a href="{{ route('apprenants.create') }}" class="btn btn-primary my-3"><i class="fas fa-plus-circle"></i><span> Nouveau Apprenant </span></a>

    <!-- cadre general -->
<div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Liste des apprenants</h3>
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
                                <table id="example1" class="table table-bordered table-striped">
                                  <hr>
                                <thead>
                                    <th scope="col">Numero</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Téléphone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Ifad</th>
                                </thead>

                                    <tbody>
                                    @foreach($apprenants as $key=>$apprenant)
                                    <tr>
                                    <th scope="row"> {{++$key}} </th>
                                    <th scope="row"> {{$apprenant->nomuser}} {{$apprenant->prenomuser}} </th>
                                    <th scope="row"> {{$apprenant->teluser}} </th>
                                    <td> <a href="{{ route('apprenants.show', ['apprenant' => $apprenant->id]) }}" style="color:rgb(55, 144, 246);"> {{$apprenant->email}} </a> </td>
                                    <th scope="row"> {{$apprenant->libelleifad}} </th>
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
