@extends('layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tuteur/Tutrice</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Tuteur/Tutrice</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <a href="{{ route('appartenances.create') }}" class="btn btn-primary my-3"><i class="fas fa-plus-circle"></i><span> Nouveau </span></a>



    <!-- cadre general -->
<div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Liste des tuteurs</h3>
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
                                    <th scope="col">Login</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Téléphone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Entreprise</th>
                                </thead>

                                    <tbody>
                                    @foreach($appartenances as $key=>$appartenance)
                                    <tr>
                                    <th scope="row"> {{++$key}} </th>
                                    <th scope="row"> {{$appartenance->user->name}} </th>
                                    <td> <a href="{{ route('appartenances.show', ['appartenance' => $appartenance->id]) }}" style="color:rgb(55, 144, 246);"> {{$appartenance->user->nomuser}} {{$appartenance->user->prenomuser}} </a></td>
                                     @if($appartenance->user->teluser)
                                     <th scope="row"> {{$appartenance->user->teluser}}  </th>
                                     @else
                                     <th scope="row"> -- Aucune valeur trouvée --  </th>
                                     @endif
                                     @if($appartenance->user->email)
                                     <th scope="row"> {{$appartenance->user->email}}  </th>
                                     @else
                                     <th scope="row"> -- Aucune valeur trouvée --  </th>
                                     @endif
                                    <th scope="row"> {{$appartenance->entreprise->libelleentreprise}}  </th>
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
