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

       <div class="row">
           @if($fiche_positionnement->association->user->imageuser)
          <div class="col-12 col-sm-1">
            <div class="form-group">
                  <h6>
                  <img src="{{ asset('storage/image/' .$fiche_positionnement->association->user->imageuser) }}" alt="user-ImageUser" class="img-thumbnail" style="width: 150px; height: 150px;">
                  </h6>
            </div>
          </div>
          @endif

            <div class="col-12 col-sm-7">
              <div class="form-group">
                    <h6><strong> {{$fiche_positionnement->association->user->nomuser}} {{$fiche_positionnement->association->user->prenomuser}}</strong></h6>
                    <h6><strong> {{$fiche_positionnement->association->classe->metier->ifad->libelleifad}}</strong></h6>
              </div>
            </div>

            <div class="col-12 col-sm-4">
              <div class="form-group">
                  <div class="form-group clearfix">
                    <h6><strong> (0) Non observé </strong></h6>
                    <h6><strong> (1) L'activité a été observée </strong></h6>
                    <h6><strong> (2) L'activité a été réalisée avec de l'aide </strong></h6>
                    <h6><strong> (3) L'activité a été réalisée en toute autonomie </strong></h6>
                    <h6><strong> (4) L'activité a été réalisée et maîtrisée </strong></h6>
                 </div>
              </div>
            </div>
         </div>
         <a href="javascript:history.back();" class="btn btn-primary my-2"><i class="fas fa-angle-left"></i> Retour</a>
         @can('admin','App\Models\User')
         <a href="{{ route('fiche_edit', ['fiche_positionnement' => $fiche_positionnement->id]) }}" class="btn btn-primary my-2"><i class="far fa-edit"></i>Modifier</a>
         @endcan
         @can('charge_suivi','App\Models\User')
         <a href="{{ route('fiche_edit', ['fiche_positionnement' => $fiche_positionnement->id]) }}" class="btn btn-primary my-2"><i class="far fa-edit"></i>Modifier</a>
         @endcan
         <!-- cadre general -->
<div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">{{ $fiche_positionnement->libellefiche }} </h3>
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
                            @can('admin','App\Models\User')
                            <form action="{{ route('fiche_positionnements.destroy', ['fiche_positionnement' => $fiche_positionnement->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                            @endcan
                            @can('ad_re_su','App\Models\User')
                            <a href="{{ route('fiche_archive', ['fiche_positionnement' => $fiche_positionnement->id]) }}" class="btn btn-success float-right"><i class="fas fa-folder-open"></i> Archiver</a>
                            @endcan
                            <table id="#" class="table table-bordered table-striped">
                                  <hr>
                                <thead>
                                    <th scope="col">Numéro</th>
                                    <th scope="col">Activité</th>
                                    <th scope="col">Tâche et positionnement</th>
                                </thead>

                                    <tbody>
                                    @foreach ($collections as $key=>$collection)
                                    <tr>
                                    <th scope="row"> {{$key++}} </th>
                                    <th scope="row"> {{$collection['activite_libelle']}}</th>
                                    <th scope="row">
                                            <table id="#" class="table table-bordered table-hover">
                                              <thead>
                                                  <th scope="col" style="color:rgb(55, 144, 246);" class="col-12 col-sm-10">Tâche </th>
                                                  <th scope="col" style="color:rgb(55, 144, 246);" class="col-12 col-sm-2">Position </th>
                                              </thead>

                                              <tbody>
                                                 @foreach ($collection['taches'] as $tache_positionnement)
                                                  <tr>
                                                    <th scope="row"> {{$tache_positionnement->libelletache}} </th>
                                                    <th scope="row">
                                                      <div class="col-12">
                                                        {{$tache_positionnement->valeurpost}}
                                                      </div>
                                                    </th>
                                                  </tr>
                                                  @endforeach
                                              </tbody>
                                           </table>
                                    </th>
                                    </tr>
                                    @endforeach
                                    </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <div class="row no-print">

          <div class="col-12">
            <a href="{{ route('statistique_generale', ['user' => $user->id]) }}" class="btn btn-primary"> <i class="fas fa-chart-line"></i><span> Radars de positionement générale </span> </a>
            <button onclick="window.print()" class="btn btn-success my-2"><i class="far fa-credit-card"></i> Imprimer</button>
          </div>
      </div>

@endsection
