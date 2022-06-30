@csrf
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Observation</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Observation</li>
            </ol>
           </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>

    <!-- cadre general -->
    <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Observation</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="user" class="nav-icon fas fa-file"></span>
    </div>
  </div>
  <!-- /fin cadre -->

    <!-- /.content-header -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                @foreach ($fiche_positionnements as $fiche_positionnement)
                    <div class="text-center">
                       <h4> Observation de la fiche de positionnement: {{ $fiche_positionnement->libellefiche }} </h4>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fas fa-comments"></i></span>
                        </div>
                        <input type="number" hidden  name="fiche_positionnement_id" value="{{$fiche_positionnement->id}}">
                        <input type="text" hidden  name="fiche_positionnement_name" value="{{$fiche_positionnement->libellefiche}}">
                        <textarea cols="10" class="form-control @error('descriptionobservation') is-invalid @enderror" name="descriptionobservation" placeholder="Rentrez une observation..." autofocus  required></textarea>
                        @error('descriptionobservation')
                            <div class="invalid-feedback">
                                {{ $errors->first('descriptionobservation')}}
                            </div>
                        @enderror
                    </div>
                @endforeach
           </div>
        </div>
    </div>
</div>
