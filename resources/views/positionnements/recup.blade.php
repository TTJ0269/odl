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
               <div class="col-12">
                   <div class="card-body">
                        <br>
                       <div class="text-center">
                        <strong style="color:rgb(55, 144, 246);"> Positionner un(e) apprenant(e) </strong>
                       </div>
                        <br>

                        <form action="{{ route('positionnement_create') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          
                          <input type="number" hidden value="{{$user->id}}" name="user_id"/>

                        <div class="row">
                          @foreach ($collections as $collection)
                               <div class="col-12 col-sm-4">
                                   <div class="card card-info collapsed-card">
                                       <div class="card-header">
                                           <h3 class="card-title">{{$collection['activite_libelle']}}</h3>

                                           <div class="card-tools">
                                               <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                               <i class="fas fa-plus"></i>
                                               </button>
                                           </div>
                                       </div>
                                       <div class="card-body">
                                           <div class="container-fluid">
                                               @foreach($collection['taches'] as $tache)
                                                 <div class="row">
                                                     <div class="col-12 col-sm-11">
                                                        <label class="form-check-label"> <i> {{$tache->libelletache}} </i> </label>
                                                     </div>
                                                     <div class="col-12 col-sm-1">
                                                        <input  class="form-check-input" type="text" hidden value="{{$tache->libelletache}}" name="tache_libelle_{{$tache->id}}">
                                                        <input class="form-check-input" type="checkbox" value="{{$tache->id}}" name="tache_id_{{$tache->id}}">
                                                     </div>
                                                 </div>
                                               @endforeach
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           @endforeach
                       </div>


                       <div class="text-center">
                          <button class="btn btn-primary my-3"> Suivant <i class="fas fa-angle-right"></i></button>
                       </div>
                     </form>

                    </div>
               </div>
           </div>
        </div>
    </div>
@endsection
