@extends('layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Fiche de positionnement</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Fiche de positionnement</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
   <!-- <a href="{{ route('fiche_positionnements.create') }}" class="btn btn-primary my-3">Nouveau livret</a> -->

    <!-- cadre general -->
<div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Liste des fiches archivées</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="user" class="nav-icon fas fa-book-open"></span>
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
                                    <th scope="col">Entreprise</th>
                                    <th scope="col">IFAD</th>
                                    <th scope="col">Action</th>
                                </thead>

                                    <tbody>
                                    @foreach($fiche_positionnements as $key=>$fiche_positionnement)
                                    <tr>
                                    <th scope="row"> {{++$key}} </th>
                                    <td> <a href="{{ route('fiche_show', ['fiche_positionnement' => $fiche_positionnement->id]) }}" style="color:rgb(55, 144, 246);"> {{$fiche_positionnement->libellefiche}} </a></td>
                                      @if ($fiche_positionnement->nom_entreprise)
                                    <th scope="row"> {{$fiche_positionnement->nom_entreprise}} </th>
                                      @else
                                    <th scope="row"> -- Aucune valeur trouvée -- </th>
                                      @endif
                                    <th scope="row"> {{$fiche_positionnement->association->ifad->libelleifad}} </th>
                                    <td> <a href="{{ route('fiche_desarchive', ['fiche_positionnement' => $fiche_positionnement->id]) }}" class="btn btn-primary"><i class="fas fa-folder-minus"></i> Désarchiver </a></td>
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
