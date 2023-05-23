@extends('layouts.appetat')

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

    <a href="javascript:history.back();" class="btn btn-primary my-2"><i class="fas fa-angle-left"></i> Retour</a>

<div class="row">
    <div class="col-12 col-sm-1">
    </div>
    <div class="col-12 col-sm-10">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <th scope="col"> <h6> <strong>Nombre de positionnement par formateur </strong></h6></th>
            </thead>
            <tbody>
            <tr>
            <th scope="row"> <canvas id="etat" width="50" height="23"></canvas> </th>
            <tr>
            </tbody>
        </table>
    </div>
    <div class="col-12 col-sm-1">
    </div>
</div>

    <!-- cadre general -->
<div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Liste des formateurs (Etat de positionnement)</h3>
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
                                    <th scope="col">Nombre de positionnement</th>
                                    <th scope="col">Métier</th>
                                    <th scope="col">IFAD</th>
                                </thead>

                                    <tbody>
                                    @foreach($formateurs as $key=>$formateur)
                                    <tr>
                                    <th scope="row"> {{++$key}} </th>
                                    <td> <a href="{{ route('show_nombrepositionnement', ['user' => $formateur->id]) }}" style="color:rgb(55, 144, 246);"> {{$formateur->nomuser}} {{$formateur->prenomuser}} </a></td>
                                    <th scope="row" style="color: rgb(9, 98, 63)"> {{$formateur->postionnements_count}}  </th>
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

     <div class="col-12">
        <div class="row no-print">
          <button onclick="window.print()" class="btn btn-success my-2"><i class="far fa-credit-card"></i> Imprimer</button>
        </div>
     </div>
@endsection
