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
            <br>
            <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    @foreach ($fiches as $fiche)
                       <h5> {{$fiche->libellefiche}} </h5>
                       <h5> IFAD: {{$fiche->association->ifad->libelleifad}} </h5>
                    @endforeach

                    @foreach ($classes as $classe)
                       <h5> Classe: {{$classe->libelleclasse}} </h5>
                    @endforeach
                  </div>
                </div>

                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                    </div>
                  </div>
           </div>

            @foreach ($collections as $collection)
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{$collection['competence_libelle']}}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                        <a href="#"> </a>
                            <canvas id="activite{{$collection['competence_id']}}"></canvas>
                        </div>
                    </div>
                </div>
            @endforeach
       </div>

      <div class="row no-print">
          <div class="col-12">
            <button onclick="window.print()" class="btn btn-success my-2"><i class="far fa-credit-card"></i>Imprimer</button>
          </div>
      </div>

@endsection


