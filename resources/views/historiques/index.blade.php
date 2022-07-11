@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Historique</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
             <li class="breadcrumb-item active">Historique</li>
           </ol>
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <!-- cadre general -->
<div class="card card-secondary direct-chat direct-chat-secondary">
 <div class="card-header">
   <h3 class="card-title">Liste de l'historique</h3>
   <div class="card-tools">
     <span data-toggle="tooltip" title="user" class="nav-icon fas fa-folder-open"></span>
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
                                   <th scope="col">Utilisateur</th>
                                   <th scope="col">Table</th>
                                   <th scope="col">Action</th>
                                   <th scope="col">Attribute</th>
                                   <th scope="col">Date</th>
                               </thead>

                                   <tbody>
                                   @foreach($historiques as $key=>$historique)
                                   <tr>
                                   <th scope="row"> {{++$key}} </th>
                                   <th scope="row"> {{$historique->user_action}} </th>
                                   <th scope="row"> {{$historique->table}} </th>
                                   <th scope="row"> {{$historique->action}} </th>
                                   <th scope="row"> {{$historique->attribute}} </th>
                                   <th scope="row"> {{$historique->created_at}} </th>
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
