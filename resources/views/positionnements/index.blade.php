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

                    <table id="example1" class="table table-bordered table-striped">
                        <hr>
                      <thead>
                          <th scope="col">Numéro</th>
                          <th scope="col">Photo</th>
                          <th scope="col">Nom</th>
                          <th scope="col">Prénom</th>
                             @cannot('charge_suivi','App\Models\User')
                          <th scope="col">Entreprise</th>
                             @endcannot
                          <th scope="col">Date début</th>
                          <th scope="col">Date fin</th>
                          <th scope="col">Fiche de positionnement</th>
                          <th scope="col">Observation</th>
                      </thead>

                          <tbody>
                          @foreach($suivis as $key=>$suivi)
                          <tr>
                          <th scope="row"> {{++$key}} </th>
                          @if($suivi->user->imageuser)
                          <th scope="row">
                            <img src="{{ asset('storage/image/' .$suivi->user->imageuser) }}" alt="user-ImageUser" class="img-circle elevation-2" style="width: 50px; height: 70px;">
                          </th>
                          @else
                           <th scope="row"> -- Photo non trouvée -- </th>
                          @endif
                          <th scope="row"> {{$suivi->user->nomuser}} </th>
                          <th scope="row"> {{$suivi->user->prenomuser}} </th>
                             @cannot('charge_suivi','App\Models\User')
                          <th scope="row"> {{$suivi->entreprise->libelleentreprise}} </th>
                             @endcannot
                            @if($suivi->datedebut)
                             <th scope="row"> {{$suivi->datedebut}}</th>
                            @else
                            <th scope="row"> Pas définie</th>
                            @endif
                            @if($suivi->datefin)
                            <th scope="row">{{$suivi->datefin}}</th>
                            @else
                            <th scope="row"> Pas définie</th>
                            @endif
                          <td> <a href="{{ route('positionnement_recup_metier', ['suivi' => $suivi->id]) }}" class="btn btn-primary"> Positionner </a></td>
                            @can('admin','App\Models\User')
                            <th><a href="{{ route('observation_create', ['user' => $suivi->user->id]) }}" class="btn btn-warning"> <i class="fas fa-comments"></i><span> </span> </a></th>
                            @endcan
                            @can('charge_suivi','App\Models\User')
                            <th><a href="{{ route('observation_create', ['user' => $suivi->user->id]) }}" class="btn btn-warning"> <i class="fas fa-comments"></i><span> </span> </a></th>
                            @endcan
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
