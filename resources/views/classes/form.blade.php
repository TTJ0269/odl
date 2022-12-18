@csrf
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Classe</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Classe</li>
            </ol>
           </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>

 <!-- cadre general -->
 <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Classe</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="classe" class="nav-icon fas fa-door-open"></span>
    </div>
  </div>
  <!-- /fin cadre -->

    <!-- /.content-header -->
<div class="content">
    <div class="container-fluid">
    <hr>

    <div class="form-group row">
      <label for="text" class="col-sm-2 col-form-label">Niveau</label>
      <div class="col-sm-10">
        <div class="input-group mb-3">
            <div class="input-group-append">
              <span class="input-group-text"><i class="nav-icon fas fa-signature"></i></span>
            </div>
            <select class="custom-select @error('niveau_id') is-invalid @enderror" name="niveau_id">
              @foreach($niveaux as $niveau)
                <option value="{{ $niveau->id}}" {{ $class->niveau_id == $niveau->id ? 'selected' : ''}}> {{ $niveau->libelleniveau }} </option>
              @endforeach
            </select>
         </div>
            @error('niveau_id')
            <div class="invalid-feedback">
                {{ $errors->first('niveau_id')}}
            </div>
          @enderror
       </div>
    </div>

    <div class="form-group row">
      <label for="text" class="col-sm-2 col-form-label">Metier</label>
      <div class="col-sm-10">
        <div class="input-group mb-3">
            <div class="input-group-append">
              <span class="input-group-text"><i class="nav-icon fas fa-school"></i></span>
            </div>
            <select class="custom-select @error('metier_id') is-invalid @enderror" name="metier_id">
              @foreach($metiers as $metier)
                <option value="{{ $metier->id}}" {{ $class->metier_id == $metier->id ? 'selected' : ''}}> {{ $metier->libellemetier }} ({{ $metier->ifad->libelleifad }}) </option>
              @endforeach
            </select>
         </div>
            @error('metier_id')
            <div class="invalid-feedback">
                {{ $errors->first('metier_id')}}
            </div>
          @enderror
       </div>
    </div>

        <div class="form-group row">
            <label for="text" class="col-sm-2 col-form-label">Libelle</label>
                <div class="col-sm-10">
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="nav-icon fas fa-signature"></i></span>
                    </div>
                    <input type="text" class="form-control @error('libelleclasse') is-invalid @enderror" name="libelleclasse" placeholder="Rentrez le libelle..." value="{{ old('libelleclasse') ?? $class->libelleclasse }}" autofocus  required/>
                    @error('libelleclasse')
                        <div class="invalid-feedback">
                            {{ $errors->first('libelleclasse')}}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <!--<div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">Niveau</label>
            <div class="col-sm-10">
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="nav-icon fas fa-signature"></i></span>
                    </div>
                    <input type="text" class="form-control @error('niveauclasse') is-invalid @enderror" name="niveauclasse" placeholder="Rentrez le niveau..."/>
                    @error('niveauclasse')
                        <div class="invalid-feedback">
                            {{ $errors->first('niveauclasse')}}
                        </div>
                    @enderror
            </div>
        </div>-->
    </div>

    </div>
</div>
