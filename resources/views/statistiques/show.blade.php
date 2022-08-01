@extends('layouts.appstatistique')

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

   <!-- Main content -->
       <div class="container">

        <div class="text-center">
            <img src="{{ asset('storage/imageifad/aedsuivi.png') }}" class="img elevation" style="width: 200px; height: 100px;" alt="AED Image">
        </div>

            <br>
            <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <h6> Fiche de positionnement </h6>
                    <h6> {{$fiche_positionnement->association->ifad->libelleifad}} </h6>
                    <h6> Métier: {{$fiche_positionnement->metier_apprenant}} </h6>
                    <h6> Apprenant(e): {{$fiche_positionnement->association->user->nomuser}} {{$fiche_positionnement->association->user->prenomuser}} </h6>
                    <h6> Date de l'évaluation: {{$fiche_positionnement->dateenregistrement}} </h6>
                  </div>
                </div>

                  <div class="col-12 col-sm-6">
                    <div class="form-group float-right">
                        <h6> Entreprise: {{$fiche_positionnement->nom_entreprise}} </h6>
                        <h6> Tél-Entreprise: {{$fiche_positionnement->tel_entreprise}} </h6>
                        <h6> Mail-Entreprise: {{$fiche_positionnement->email_entreprise}} </h6>
                        <h6> Adresse-Entreprise: {{$fiche_positionnement->adresse_entreprise}} </h6>
                        <h6> Tuteur: {{$fiche_positionnement->nom_tuteur}} {{$fiche_positionnement->prenom_tuteur}} </h6>
                        <h6> Tél-Tuteur: {{$fiche_positionnement->tel_tuteur}} </h6>
                    </div>
                  </div>
           </div>

            @foreach ($collections as $collection)
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{$collection['activite_libelle']}}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="activite{{$collection['activite_id']}}"></canvas>
                        </div>
                    </div>
                </div>
            @endforeach
       </div>

      <div class="row no-print">
          <div class="col-12">
            <a href="javascript:history.back();" class="btn btn-primary"><i class="fas fa-angle-left"></i> Retour</a>
            <button onclick="window.print()" class="btn btn-success my-2"><i class="far fa-credit-card"></i>Imprimer</button>
          </div>
      </div>

@endsection


