@csrf
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Activité</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Activité</li>
            </ol>
           </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>

    <!-- cadre general -->
    <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Activité</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="user" class="nav-icon fas fa-copy"></span>
    </div>
  </div>
  <!-- /fin cadre -->

    <!-- /.content-header -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

               <div class="content">
                      <hr>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="text" class="col-sm-2 col-form-label">Libelle</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                      <span class="input-group-text"><i class="nav-icon fas fa-signature"></i></span>
                                    </div>
                                    <input type="text" class="form-control @error('libelleactivite') is-invalid @enderror" name="libelleactivite" placeholder="Rentrez le libelle..." value="{{ old('libelleactivite') ?? $activite->libelleactivite }}" autofocus  required/>
                                    @error('libelleactivite')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('libelleactivite')}}
                                        </div>
                                    @enderror
                                 </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="text" class="col-sm-2 col-form-label">Identifiant</label>
                            <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-audio-description"></i></span>
                                </div>
                                <input type="text" class="form-control @error('identifiantactivite') is-invalid @enderror" name="identifiantactivite" placeholder="identifiant" value="{{ old('identifiantactivite') ?? $activite->identifiantactivite }}" autofocus  required/>
                                @error('identifiantactivite')
                                <div class="invalid-feedback">
                                    {{ $errors->first('identifiantactivite')}}
                                </div>
                                @enderror
                            </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="text" class="col-sm-2 col-form-label">Fonction</label>
                            <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="nav-icon fas fa-bookmark"></i></span>
                                </div>
                                <select class="custom-select select2bs4  @error('groupe_activite_id') is-invalid @enderror" name="groupe_activite_id">
                                    <option selected disabled> Sélectionner une fonction</option>
                                    @foreach($groupe_activites as $groupe_activite)
                                    <option value="{{ $groupe_activite->id }}" {{ $activite->groupe_activite_id == $groupe_activite->id ? 'selected' : ''}}> {{ $groupe_activite->libellegroupe }}</option>
                                    @endforeach
                                </select>
                            </div>
                                @error('groupe_activite_id')
                                <div class="invalid-feedback">
                                    {{ $errors->first('groupe_activite_id')}}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="text" class="col-sm-2 col-form-label">Catégorie</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                  <span class="input-group-text"><i class="nav-icon fas fa-signature"></i></span>
                                </div>
                                <input type="text" class="form-control @error('categorie') is-invalid @enderror" name="categorie" placeholder="Rentrez la categorie..." value="{{ old('categorie') ?? $activite->categorie }}"/>
                                @error('categorie')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('categorie')}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                  </div>

                </div>
            </div>
        </div>
    </div>
</div>
