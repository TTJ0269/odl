@extends('layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Liste des positionnements</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Liste des positionnements</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <a href="javascript:history.back();" class="btn btn-primary my-2"><i class="fas fa-angle-left"></i> Retour</a>

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
                              <th scope="col">Libelle</th>
                          </thead>

                              <tbody>
                              @foreach($nombre_postionnements as $key=>$fiche_positionnement)
                              <tr>
                              <th scope="row"> {{++$key}} </th>
                              <td> <a href="{{ route('fiche_show', ['fiche_positionnement' => $fiche_positionnement->id]) }}" style="color:rgb(55, 144, 246);"> {{$fiche_positionnement->libellefiche}} </a></td>
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
