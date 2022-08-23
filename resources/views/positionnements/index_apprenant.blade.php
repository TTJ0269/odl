@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Stagiaire</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
             <li class="breadcrumb-item active">Stagiaire</li>
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
   <h3 class="card-title">Liste des stagiaires</h3>
   <div class="card-tools">
     <span data-toggle="tooltip" title="user" class="nav-icon fas fa-signal"></span>
   </div>
 </div>
 <!-- /fin cadre -->

   <!-- Main content -->
   <div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-12">
                   <div class="card-body">
                    <br>

                    <table id="example1" class="table table-bordered table-striped">
                        <hr>
                      <thead>
                          <th scope="col">Numéro</th>
                          <th scope="col">Nom</th>
                          <th scope="col">Prénom</th>
                          <th scope="col">Action</th>
                      </thead>

                          <tbody>
                          @foreach($users as $key=>$user)
                          <tr>
                          <th scope="row" class="col-12 col-sm-3"> {{++$key}} </th>
                          <th scope="row" class="col-12 col-sm-3"> {{$user->nomuser}} </th>
                          <th scope="row" class="col-12 col-sm-3"> {{$user->prenomuser}} </th>
                          <th scope="row" class="col-12 col-sm-3">
                            <a href="{{ route('positionnement_recup_apprenant', ['user' => $user->id]) }}" class="btn btn-primary"> Fiche du suivi </a>
                            <a href="{{ route('positionnement_create', ['user' => $user->id]) }}" class="btn btn-primary"> Positionner </a>
                            @can('admin','App\Models\User')
                            <a href="{{ route('observation_create', ['user' => $user->id]) }}" class="btn btn-warning"> <i class="fas fa-comments"></i><span> </span> </a>
                            @endcan
                            @can('charge_suivi','App\Models\User')
                            <a href="{{ route('observation_create', ['user' => $user->id]) }}" class="btn btn-warning"> <i class="fas fa-comments"></i><span> </span> </a>
                            @endcan
                            @can('formateur_ifad','App\Models\User')
                            <a href="{{ route('observation_create', ['user' => $user->id]) }}" class="btn btn-warning"> <i class="fas fa-comments"></i><span> </span> </a>
                            @endcan
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
</div>

<hr>
<h6 style="color:rgb(209, 16, 16);">NB: </h6>
<div class="row">
    <div class="col-12 col-sm-4">
      <div class="form-group">
        <h6> Pour visualiser les fiches du suivi  d’un(e) apprenant(e) cliquez sur le bouton <button class="btn btn-primary"> Fiche du suivi </button> devant son nom. </h6>
      </div>
    </div>

    <div class="col-12 col-sm-4">
        <div class="form-group">
          <h6> Pour aller sur la fiche de positionnement  d’un(e) apprenant(e) cliquez sur le bouton <button class="btn btn-primary"> Positionner </button> à côté son nom. </h6>
        </div>
      </div>

      <div class="col-12 col-sm-4">
        <div class="form-group">
          <h6> Pour faire des observations par rapport aux comportements ou travail de l’apprenant(e) cliquez sur l’icone. <button class="btn btn-warning"> <i class="fas fa-comments"></i><span> </span> </button> </h6>
        </div>
      </div>
    </div>

@endsection