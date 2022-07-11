@extends('layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Entreprise</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Entreprise</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <a href="{{ route('entreprises.create') }}" class="btn btn-primary my-3"><i class="fas fa-plus-circle"></i><span> Nouvelle entreprise </span></a>

    <!-- cadre general -->
    <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Liste des entreprises</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="user" class="nav-icon fas fa-users"></span>
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
                                    <th scope="col">Téléphone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Adresse</th>
                                </thead>

                                    <tbody>
                                    @foreach($entreprises as $key=>$entreprise)
                                    <tr>
                                    <th scope="row"> {{++$key}} </th>
                                    <td> <a href="{{ route('entreprises.show', ['entreprise' => $entreprise->id]) }}" style="color:rgb(55, 144, 246);"> {{$entreprise->libelleentreprise}} </a></td>
                                    @if ($entreprise->telentreprise)
                                    <th scope="row"> {{$entreprise->telentreprise}} </th>
                                    @else
                                    <th scope="row"> -- Aucune valeur trouvée -- </th>
                                    @endif
                                    @if ($entreprise->emailentreprise)
                                    <th scope="row"> {{$entreprise->emailentreprise}} </th>
                                    @else
                                    <th scope="row"> -- Aucune valeur trouvée -- </th>
                                    @endif
                                    @if ($entreprise->adresseentreprise)
                                    <th scope="row"> {{$entreprise->adresseentreprise}} </th>
                                    @else
                                    <th scope="row"> -- Aucune valeur trouvée -- </th>
                                    @endif
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
