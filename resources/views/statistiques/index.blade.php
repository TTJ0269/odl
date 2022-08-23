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


 <div class="col-12 col-sm-12">
    <div class="card card-info collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Fiche de positionnement</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <br>
                <form action="{{ route('statistique_show_info') }}" method="POST" enctype="multipart/form-data">
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
                                     <option value="{{ $user->id }}"> {{ $user->nomuser }} {{ $user->prenomuser }}</option>
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

   <!-- cadre general -->
<div class="card card-secondary direct-chat direct-chat-secondary">
 <div class="card-header">
   <h3 class="card-title">Statistique</h3>
   <div class="card-tools">
     <span data-toggle="tooltip" title="user" class="nav-icon fas fa-signal"></span>
   </div>
 </div>
 <!-- /fin cadre -->


    <div class="card-body">
        <div class="container-fluid">
            <table id="example1" class="table table-bordered table-striped">
                <hr>
            <thead>
                <th scope="col">Numero</th>
                <th scope="col">Nom</th>
                <th scope="col">Classe</th>
                <th scope="col">IFAD</th>
                <th scope="col">Fiche positionnement</th>
            </thead>

                <tbody>
                @foreach($users as $key=>$user)
                <tr>
                <th scope="row"> {{++$key}} </th>
                <th scope="row"> {{$user->nomuser}} {{$user->prenomuser}} </th>
                @if ($user->libelleclasse)
                <th scope="row"> {{$user->libelleclasse}} </th>
                @else
                <th scope="row"> -- Aucune valeur trouvée -- </th>
                @endif
                @if ($user->libelleifad)
                <th scope="row"> {{$user->libelleifad}} </th>
                @else
                <th scope="row"> -- Aucune valeur trouvée -- </th>
                @endif
                <td> <a href="{{ route('fiche_generale', ['user' => $user->id]) }}" style="color:rgb(55, 144, 246);"> Générale </a> </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

