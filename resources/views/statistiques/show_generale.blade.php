@extends('layouts.appstatistique_generale')

@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Radars des positionnements généraux</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
             <li class="breadcrumb-item active">Radars des positionnements généraux</li>
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
                <img src="{{ asset('storage/imageifad/'.$metiers->ifad->logoifad) }}" class="img elevation" style="width: 100px; height: 50px;" alt="AED Image">
            </div>
            <div class="col-12 col-sm-6">
                <div class="text-center">
                    <h2> <strong> Fiche de positionnement</strong> </h2>
                    <h5> {{$metiers->libellemetier}} </h5>
                    <h5> {{ now() }} </h5>
                </div>
            </div>
            <div class="col-12 col-sm-3">
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <h6> Apprenant(e): {{$user->nomuser}} {{$user->prenomuser}} </h6>
              </div>
            </div>

              <div class="col-12 col-sm-6">
                <div class="form-group float-right">
                </div>
              </div>
       </div>

            @foreach ($collections as $collection)
               @foreach($collection['groupe_activites'] as $groupe_activite)
                 @foreach($groupe_activite['activites'] as $activite)
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{$activite['activite_libelle']}}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="activite{{$activite['activite_id']}}" width="50" height="25"></canvas>
                            </div>
                        </div>
                    </div>
                 @endforeach
              @endforeach
            @endforeach
       </div>

      <div class="row no-print">
          <div class="col-12">
            <a href="javascript:history.back();" class="btn btn-primary"><i class="fas fa-angle-left"></i> Retour</a>
            <button onclick="window.print()" class="btn btn-success my-2"><i class="far fa-credit-card"></i>Imprimer</button>
          </div>
      </div>

@endsection


