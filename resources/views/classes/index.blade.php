@extends('layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Classe</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Classe</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <a href="{{ route('classes.create') }}" class="btn btn-primary my-3"><i class="fas fa-plus-circle"></i><span> Nouvelle classe </span></a>

    <!-- cadre general -->
    <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Liste des classes</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="classe" class="nav-icon fas fa-door-open"></span>
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
                                    <th scope="col">Libelle</th>
                                    <th scope="col">Niveau</th>
                                    <th scope="col">Metier</th>
                                    <th scope="col">IFAD</th>
                                </thead>

                                    <tbody>
                                    @foreach($classes as $key=>$classe)
                                    <tr>
                                    <th scope="row"> {{++$key}} </th>
                                    <td> <a href="{{ route('classes.show', ['class' => $classe->id]) }}"> {{$classe->libelleclasse}} </a></td>
                                    <th scope="row"> {{$classe->niveau->libelleniveau}} </th>
                                    <th scope="row"> {{$classe->metier->libellemetier}} </th>
                                    <th scope="row"> {{$classe->metier->ifad->libelleifad}} </th>
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
