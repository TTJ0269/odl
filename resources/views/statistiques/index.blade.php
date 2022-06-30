@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Statistique</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
             <li class="breadcrumb-item active">Statistique</li>
           </ol>
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <!-- cadre general -->
<div class="card card-secondary direct-chat direct-chat-secondary">
 <div class="card-header">
   <h3 class="card-title">Statistique</h3>
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
                       <div class="text-center">
                        <strong style="color:rgb(55, 144, 246);"> Sélectionner l'apprenant(e) puis sa fiche de positionnement </strong>
                       </div>
                        <br>

                        <form action="{{ route('statistique_show') }}" method="POST" enctype="multipart/form-data">
                          @csrf

                         <div class="form-group row">
                           <label for="name" class="col-sm-2 col-form-label">Apprenant(e)</label>
                             <div class="col-sm-10">
                                 <div class="input-group mb-3">
                                     <div class="input-group-append">
                                       <span class="input-group-text"><i class="fas fa-user"></i></span>
                                     </div>
                                       <select class="custom-select select2bs4" name="user_id" id="user">
                                           <option selected disabled>Sélectionner un(e) apprenant(e)</option>
                                           @foreach ($users as $user)
                                           <option value="{{ $user->id }}"> {{ $user->nomuser }} {{ $user->prenomuser }} </option>
                                           @endforeach
                                       </select>
                                 </div>
                             </div>
                         </div>

                         <div class="form-group row">
                           <label for="name" class="col-sm-2 col-form-label">Fiche de positionnement</label>
                             <div class="col-sm-10">
                                 <div class="input-group mb-3">
                                     <div class="input-group-append">
                                       <span class="input-group-text"><i class="fas fa-book-open"></i></span>
                                     </div>
                                         <select class="custom-select select2bs4" name="fiche_positionnement_id" id="fichepositionnement"></select>
                                 </div>
                             </div>
                         </div>


                       <div class="text-center">
                          <button type="submit" class="btn btn-success my-2"> <i class="fas fa-check"></i> Valider </button>
                       </div>
                     </form>

                    </div>
               </div>
           </div>
        </div>
    </div>
@endsection
