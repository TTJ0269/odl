@csrf
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Groupe d'activité</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Groupe d'activité</li>
            </ol>
           </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>

 <!-- cadre general -->
 <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Groupe d'activité</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="users" class="nav-icon fas fa-bookmark"></span>
    </div>
  </div>
  <!-- /fin cadre -->

    <!-- /.content-header -->
<div class="content">
    <div class="container-fluid">
    <hr>

    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">Métier</label>
        <div class="col-sm-10">
        <div class="input-group mb-3">
            <div class="input-group-append">
                <span class="input-group-text"><i class="nav-icon fas fa-chalkboard-teacher"></i></span>
            </div>
            <select class="custom-select select2bs4  @error('metier_id') is-invalid @enderror" name="metier_id">
                <option selected disabled> Sélectionner un métier</option>
                @foreach($metiers as $metier)
                <option value="{{ $metier->id }}" {{ $groupe_activite->metier_id == $metier->id ? 'selected' : ''}}> {{ $metier->libellemetier }}</option>
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
        <label for="text" class="col-sm-2 col-form-label">Identifiant</label>
        <div class="col-sm-10">
        <div class="input-group mb-3">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-audio-description"></i></span>
            </div>
            <input type="text" class="form-control @error('identifiantgroupe') is-invalid @enderror" name="identifiantgroupe" placeholder="identifiant" value="{{ old('identifiantgroupe') ?? $groupe_activite->identifiantgroupe }}"/>
            @error('identifiantgroupe')
            <div class="invalid-feedback">
                {{ $errors->first('identifiantgroupe')}}
            </div>
            @enderror
        </div>
        </div>
    </div>

    <div class="form-group row">
         <label for="text" class="col-sm-2 col-form-label">Libelle</label>
             <div class="col-sm-10">
                <div class="input-group mb-3">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="nav-icon fas fa-signature"></i></span>
                    </div>
                    <input type="text" class="form-control @error('libellegroupe') is-invalid @enderror" name="libellegroupe" placeholder="Rentrez le libelle..." value="{{ old('libellegroupe') ?? $groupe_activite->libellegroupe }}" autofocus  required/>
                    @error('libellegroupe')
                        <div class="invalid-feedback">
                            {{ $errors->first('libellegroupe')}}
                        </div>
                    @enderror
             </div>
         </div>
     </div>

    </div>
</div>
