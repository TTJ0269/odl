@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Apprenant</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
             <li class="breadcrumb-item active">Apprenant</li>
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
   <h3 class="card-title">Liste des Apprenants</h3>
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
                          <th scope="col">Nom & Prénom</th>
                          <th scope="col">Classe</th>
                             @cannot('charge_suivi','App\Models\User')
                          <th scope="col">Entreprise</th>
                             @endcannot
                          <th scope="col">Date début</th>
                          <th scope="col">Date fin</th>
                          <th scope="col">Action</th>
                      </thead>

                          <tbody>
                          @foreach($suivis as $key=>$suivi)
                          <tr>
                          <th scope="row"> {{++$key}} </th>
                          @if($suivi->imageuser)
                          <th scope="row">
                            <img src="{{ asset('storage/image/' .$suivi->imageuser) }}" alt="user-ImageUser" class="img-circle elevation-2" style="width: 50px; height: 70px;">
                          </th>
                          @else
                           <th scope="row"> -- Photo non trouvée -- </th>
                          @endif
                          <th scope="row"> {{$suivi->nomuser}} <i>{{$suivi->prenomuser}}</i>  </th>
                          @if ($suivi->libelleclasse)
                          <th scope="row"> {{ $suivi->libelleclasse }} </th>
                          @else
                          <th scope="row"> -- Aucune valeur trouvée -- </th>
                          @endif
                             @cannot('charge_suivi','App\Models\User')
                          <th scope="row"> {{$suivi->libelleentreprise}} </th>
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
                            <td>
                               <a href="{{ route('positionnement_create', ['user' => $suivi->id_user,'metier'=> $metier->id]) }}" class="btn btn-primary"> Positionner </a>
                               <a href="{{ route('positionnement_recup_apprenant', ['user' => $suivi->id_user,'metier'=> $metier->id]) }}" class="btn btn-primary"> Fiche du suivi </a>
                               @can('admin','App\Models\User')
                               <a href="{{ route('observation_create', ['user' => $suivi->id_user]) }}" class="btn btn-warning"> <i class="fas fa-comments"></i><span> </span> </a>
                               @endcan
                               @can('charge_suivi','App\Models\User')
                               <a href="{{ route('observation_create', ['user' => $suivi->id_user]) }}" class="btn btn-warning"> <i class="fas fa-comments"></i><span> </span> </a>
                               @endcan
                               @can('formateur_ifad','App\Models\User')
                               <a href="{{ route('observation_create', ['user' => $suivi->id_user]) }}" class="btn btn-warning"> <i class="fas fa-comments"></i><span> </span> </a>
                               @endcan
                            </td>

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
    <div class="col-12 col-sm-12">
      <div class="form-group">
        <h6><strong>1.</strong> Pour visualiser les fiches du suivi  d’un(e) apprenant(e) cliquez sur le bouton <strong> Fiche du suivi </strong> devant son nom. </h6>
        <h6><strong>2.</strong> Pour aller sur la fiche de positionnement  d’un(e) apprenant(e) cliquez sur le bouton <strong> Positionner </strong> à côté son nom. </h6>
        <h6><strong>3.</strong> Pour faire des observations par rapport aux comportements ou travail de l’apprenant(e) cliquez sur l’icone <strong> Commentaire. </strong> </h6>
      </div>
    </div>
</div>

@endsection
