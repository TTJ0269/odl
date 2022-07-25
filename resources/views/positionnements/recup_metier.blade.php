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
                       <div class="text-center">
                        <strong style="color:rgb(55, 144, 246);"> Sélectionner un métier puis appuyé sur suivant  </strong>
                       </div>
                        <br>

                        <form action="{{ route('positionnement_create') }}" method="POST" enctype="multipart/form-data">
                          @csrf

                          <input type="number" name="suivi_id" hidden value="{{$suivi->id}}"/>
                         <div class="form-group row">
                           <label for="name" class="col-sm-2 col-form-label">Métier</label>
                             <div class="col-sm-10">
                                 <div class="input-group mb-3">
                                     <div class="input-group-append">
                                       <span class="input-group-text"><i class="fas fa-chalkboard-teacher"></i></span>
                                     </div>
                                       <select class="custom-select select2bs4" name="metier_id" id="metier_id">
                                           <option selected disabled>Sélectionner un métier</option>
                                           @foreach ($metiers as $metier)
                                           <option value="{{ $metier->id }}"> {{ $metier->libellemetier }} </option>
                                           @endforeach
                                       </select>
                                 </div>
                             </div>
                         </div>


                       <div class="text-center">
                          <button type="submit" class="btn btn-primary my-2"> Suivant <i class="fas fa-angle-right"></i></button>
                       </div>
                     </form>

                    </div>
               </div>
           </div>
        </div>
    </div>
@endsection
