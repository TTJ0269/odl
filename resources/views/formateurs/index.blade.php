@extends('layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Formateur/Formatrice</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Formateur/Formatrice</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <a href="{{ route('formateurs.create') }}" class="btn btn-primary my-3"><i class="fas fa-plus-circle"></i><span> Nouveau </span></a>



    <!-- cadre general -->
<div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Liste des formateurs</h3>
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
                                    <th scope="col">Nom & Prénom</th>
                                    <th scope="col">Métier</th>
                                    <th scope="col">IFAD</th>
                                </thead>

                                    <tbody>
                                    @foreach($formateurs as $key=>$formateur)
                                    <tr>
                                    <th scope="row"> {{++$key}} </th>
                                    <td> <a href="{{ route('formateurs.show', ['formateur' => $formateur->id]) }}" style="color:rgb(55, 144, 246);"> {{$formateur->nomuser}} {{$formateur->prenomuser}} </a></td>
                                    <th scope="row"> {{$formateur->libellemetier}}  </th>
                                    <th scope="row"> {{$formateur->libelleifad}}  </th>
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
