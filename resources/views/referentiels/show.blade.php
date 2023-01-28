@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Référentiel</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Référentiel</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <a href="javascript:history.back();" class="btn btn-primary my-2"><i class="fas fa-angle-left"></i> Retour</a>

<div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Référentiel </h3>
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

                        <div class="row">
                            @foreach($collections as $collection)

                            <div class="col-12 col-sm-12">
                                <div class="card card-">
                                    <div class="card-header">
                                        <h3 class="card-title">{{$collection['filiere_libelle']}}</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            @foreach($collection['groupe_activites'] as $groupe_activite)
                                                <div class="col-12 col-sm-12"cd>
                                                    <div class="card card-info">
                                                        <div class="card-header">
                                                            <h3 class="card-title"> <strong> {{$groupe_activite['focntion_libelle']}} </strong></h3>

                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="container-fluid">

                                                            @foreach($groupe_activite['activites'] as $activite)
                                                                <div class="row">
                                                                    <div style="color:rgb(12, 27, 72);" class="col-12 col-sm-6"><strong> Activité </strong></div>
                                                                    <div style="color:rgb(12, 27, 72);" class="col-12 col-sm-6"><strong> Tâche(s) </strong></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12 col-sm-6">
                                                                         {{$activite['activite_libelle']}}
                                                                    </div>
                                                                    <div class="col-12 col-sm-6">
                                                                        @foreach($activite['taches'] as $tache)
                                                                            <label class="form-check-label"> <i>{{$tache->libelletache}}</i> </label>
                                                                            <hr>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                            @endforeach

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
      <div class="row no-print">

          <div class="col-12">
            <button onclick="window.print()" class="btn btn-success my-2"><i class="far fa-credit-card"></i> Imprimer</button>
          </div>
      </div>

@endsection
