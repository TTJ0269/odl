@csrf
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Profil</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Profil</li>
            </ol>
           </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>

 <!-- cadre general -->
 <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Profil</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="users" class="nav-icon fas fa-users"></span>
    </div>
  </div>
  <!-- /fin cadre -->

    <!-- /.content-header -->
<div class="content">
    <div class="container-fluid">
    <hr>
            <div class="form-group row">
                <label for="text" class="col-sm-2 col-form-label">Profil</label>
                <div class="col-sm-10">
                    <select class="form-control @error('libelleprofil') is-invalid @enderror" name="libelleprofil" id="libelleprofil">
                      <option value="Administrateur" {{ $profil->libelleprofil == "Administrateur" ? 'selected' : '' }}> Administrateur </option>
                      <option value="Responsable pédagogique" {{ $profil->libelleprofil == "Responsable pédagogique" ? 'selected' : '' }}>Responsable pédagogique</option>
                      <option value="Chargé du suivi" {{ $profil->libelleprofil == "Chargé du suivi" ? 'selected' : '' }}>Chargé du suivi</option>
                      <option value="Formateur_IFAD" {{ $profil->libelleprofil == "Formateur_IFAD" ? 'selected' : '' }}>Formateur à l'IFAD</option>
                      <option value="DG_IFAD" {{ $profil->libelleprofil == "DG_IFAD" ? 'selected' : '' }}>DG_IFAD</option>
                      <option value="Suivi_AED" {{ $profil->libelleprofil == "Suivi_AED" ? 'selected' : '' }}>Suivi_AED</option>
                      <option value="Apprenant" {{ $profil->libelleprofil == "Apprenant" ? 'selected' : '' }}>Apprenant</option>
                    </select>
                    @error('libelleprofil')
                    <div class="invalid-feedback">
                        {{ $errors->first('libelleprofil')}}
                    </div>
                    @enderror
                </div>
            </div>
    </div>
</div>
