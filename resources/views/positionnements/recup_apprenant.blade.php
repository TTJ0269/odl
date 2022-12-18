@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Positionnement</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
             <li class="breadcrumb-item active">Positionnement</li>
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
   <h3 class="card-title">Positionnement</h3>
   <div class="card-tools">
     <span data-toggle="tooltip" title="user" class="nav-icon fas fa-signal"></span>
   </div>
 </div>
 <!-- /fin cadre -->

   <!-- Main content -->
   <div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-sm-12">
                   <div class="card-body">
                        <br>

                        <div class="row">
                            @if($user->imageuser)
                          <div class="col-12 col-sm-1">
                            <div class="form-group">
                                  <h6>
                                  <img src="{{ asset('storage/image/' .$user->imageuser) }}" alt="user-ImageUser" class="img-thumbnail" style="width: 150px; height: 150px;">
                                  </h6>
                            </div>
                          </div>
                          @endif

                            <div class="col-12 col-sm-10">
                              <div class="form-group">
                                  <div class="row">
                                    <h6 class="col-12 col-sm-1"> <strong>Nom:</strong> </h6> <h6 class="col-12 col-sm-7">{{$user->nomuser}} {{$user->prenomuser}}</h6>
                                  </div>
                                  <div class="row">
                                    <h6 class="col-12 col-sm-1"> <strong>Classe:</strong> </h6> <h6 class="col-12 col-sm-7"> {{$association->classe->libelleclasse}} </h6>
                                  </div>
                                  <div class="row">
                                    <h6 class="col-12 col-sm-1"> <strong>IFAD:</strong> </h6> <h6 class="col-12 col-sm-7"> {{$association->classe->metier->ifad->libelleifad}} </h6>
                                  </div>
                               </div>
                            </div>

                            <div class="col-12 col-sm-1">
                              <div class="form-group">
                                  <div class="form-group clearfix">
                                    <a href="{{ route('positionnement_create', ['user' => $user->id,'metier'=> $metier->id]) }}" class="btn btn-primary"> Positionner </a>
                                  </div>
                              </div>
                            </div>
                         </div>

                   <h6> <strong>Historique des positionnements</strong> </h6>
                   <hr>

                   <table id="example1" class="table table-bordered table-striped">
                    <hr>
                  <thead>
                      <th scope="col">Numéro</th>
                      <th scope="col">Libelle Positionnement</th>
                      <th scope="col">Date</th>
                      <th scope="col">Lieu</th>
                      <th scope="col">Responsable</th>
                  </thead>

                      <tbody>
                      @foreach($fiche_positionnements as $key=>$fiche_positionnement)
                      <tr>
                        <th scope="row"> {{++$key}} </th>
                        <td> <a href="{{ route('fiche_show', ['fiche_positionnement' => $fiche_positionnement->id]) }}" style="color:rgb(55, 144, 246);"> {{$fiche_positionnement->libellefiche}} </a></td>
                        <th scope="row"> {{$fiche_positionnement->dateenregistrement}} </th>
                        <th scope="row"> {{$fiche_positionnement->nom_entreprise}} </th>
                        <th scope="row"> {{$fiche_positionnement->nom_tuteur}} {{$fiche_positionnement->prenom_tuteur}}</th>
                      </tr>
                      @endforeach
                      </tbody>
                  </table>

                  <br>
                    <h6> <strong>Positionnement Général</strong> </h6>
                    <hr>
                    <a href="{{ route('fiche_generale', ['user' => $user->id]) }}" class="btn btn-success my-2"> Positionnement Général </a>

                    </div>
               </div>
           </div>
        </div>
    </div>
@endsection
