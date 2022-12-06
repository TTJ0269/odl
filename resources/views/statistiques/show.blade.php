@extends('layouts.appstatistique')

@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Radars de positionnement</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
             <li class="breadcrumb-item active">Radars de positionnement</li>
           </ol>
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
   <!-- Main content -->
   <div class="container">
    <div class="row">
        <div class="col-12 col-sm-3">
            <img src="{{ asset('storage/imageifad/'.$fiche_positionnement->association->classe->metier->ifad->logoifad) }}" class="img elevation" style="width: 100px; height: 50px;" alt="AED Image">
        </div>
        <div class="col-12 col-sm-6">
            <div class="text-center">
                <h2> <strong> Fiche de positionnement</strong> </h2>
                <h5> {{$fiche_positionnement->metier_apprenant}} </h5>
                <h6> {{$fiche_positionnement->dateenregistrement}} </h6>
            </div>
        </div>
        <div class="col-12 col-sm-3">
        </div>
    </div>

            <br>
            <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <h6> Classe: {{$fiche_positionnement->association->classe->libelleclasse}} </h6>
                    <h6> Apprenant(e): {{$fiche_positionnement->association->user->nomuser}} {{$fiche_positionnement->association->user->prenomuser}} </h6>
                  </div>
                </div>

                  <div class="col-12 col-sm-6">
                    <div class="form-group float-right">
                        @if ($fiche_positionnement->nom_entreprise)
                        <h6> Entreprise: {{$fiche_positionnement->nom_entreprise}} / {{$fiche_positionnement->tel_entreprise}} / {{$fiche_positionnement->email_entreprise}} ({{$fiche_positionnement->adresse_entreprise}})</h6>
                        @endif
                        <h6> Tuteur: {{$fiche_positionnement->nom_tuteur}} {{$fiche_positionnement->prenom_tuteur}} / {{$fiche_positionnement->tel_tuteur}} </h6>
                    </div>
                  </div>
           </div>

            <div class="row">
                @foreach ($collections as $collection)
                <div class="col-12 col-sm-6">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <th scope="col"> <h6 style="font-size:0.9vw">{{$collection['activite_libelle']}} </h6></th>
                        </thead>

                        <tbody>
                        <tr>
                        <th scope="row"> <canvas id="activite{{$collection['activite_id']}}" width="50" height="35"></canvas> </th>
                        <tr>
                        </tbody>
                    </table>
                </div>
                @endforeach
            </div>
       </div>

      <div class="row no-print">
          <div class="col-12">
            <a href="javascript:history.back();" class="btn btn-primary"><i class="fas fa-angle-left"></i> Retour</a>
            <button onclick="window.print()" class="btn btn-success my-2"><i class="far fa-credit-card"></i>Imprimer</button>
          </div>
      </div>

    </div>

@endsection

