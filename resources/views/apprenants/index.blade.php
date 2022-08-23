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
                                    <th scope="col">Numéro</th>
                                    <th scope="col">Login</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Téléphone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Classe</th>
                                    <th scope="col">Métier</th>
                                    <th scope="col">IFAD</th>
                                </thead>

                                    <tbody>
                                    @foreach($apprenants as $key=>$apprenant)
                                    <tr>
                                    @if ($apprenant->numero_matricule)
                                    <th scope="row"> {{$apprenant->numero_matricule}} </th>
                                    @else
                                    <th scope="row"> {{++$key}} </th>
                                    @endif
                                    <td> <a href="{{ route('apprenants.show', ['apprenant' => $apprenant->id]) }}" style="color:rgb(55, 144, 246);"> {{$apprenant->name}} </a> </td>
                                    <th scope="row"> {{$apprenant->nomuser}} {{$apprenant->prenomuser}} </th>
                                    @if ($apprenant->teluser)
                                    <th scope="row"> {{$apprenant->teluser}} </th>
                                    @else
                                    <th scope="row"> -- Aucune valeur trouvée -- </th>
                                    @endif
                                    @if ($apprenant->email)
                                    <th scope="row"> {{$apprenant->email}} </th>
                                    @else
                                    <th scope="row"> -- Aucune valeur trouvée -- </th>
                                    @endif
                                    <th scope="row"> {{$apprenant->libelleclasse}} </th>
                                    <th scope="row"> {{$apprenant->libellemetier}} </th>
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
