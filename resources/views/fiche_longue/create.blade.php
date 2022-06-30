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

   <div class="row">
    <div class="col-12 col-sm-8">
      <div class="form-group">
      </div>
    </div>

    <div class="col-12 col-sm-4">
      <div class="form-group">
          <div class="form-group clearfix">
            <div class="icheck-danger">
            <input type="radio" id="radioDangerGrille"  name="ValeurPost_Grille1" checked >
            <label for="radioDangerGrille"> (0) Non observé </label>
            </div>
            <div class="icheck-orange">
            <input type="radio" id="radioOrangeGrille" name="ValeurPost_Grille2" checked>
            <label for="radioOrangeGrille"> (1) L'activité a été observée </label>
            </div>
            <div class="icheck-purple">
            <input type="radio" id="radioPurpleGrille" name="ValeurPost_Grille3" checked>
            <label for="radioPurpleGrille"> (2) L'activité a été réalisée avec de l'aide </label>
            </div>
            <div class="icheck-primary">
            <input type="radio" id="radioPrimaryGrille" name="ValeurPost_Grille5" checked>
            <label for="radioPrimaryGrille"> (3) L'activité a été réalisée en toute autonomie </label>
            </div>
            <div class="icheck-success">
            <input type="radio" id="radioSuccessGrille" name="ValeurPost_Grille4" checked>
            <label for="radioSuccessGrille"> (4) L'activité a été réalisée et maîtrisée </label>
            </div>
        </div>
      </div>
    </div>
 </div>


<!-- Main content -->
<div class="content">
  <div class="container-fluid">
     <div class="row">
         <div class="col-md-12">
            <form action="{{ route('fiche_apprenant_store') }}" method="POST" enctype="multipart/form-data">
            @csrf

                    <div class="row">
                        <div class="col-12 col-sm-6">
                                @include('fiche_longue.form.entreprise')
                        </div>

                        <div class="col-12 col-sm-6">
                                @include('fiche_longue.form.tuteur')
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12">
                                @include('fiche_longue.form.apprenant')
                        </div>
                    </div>

                    @include('fiche_longue.form.positionnement')


                    <div class="card-footer">
                        <a href="javascript:history.back();" class="btn btn-primary"><i class="fas fa-angle-left"></i> Retour</a>
                        <button type="submit" class="btn btn-primary float-right"> Valider <i class="fas fa-check"></i></button>
                    </div>

           </form>

        </div>
      </div>
   </div>
</div>


@endsection


