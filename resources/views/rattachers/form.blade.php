@csrf
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Rattachement</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Rattachement</li>
            </ol>
           </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>

    <!-- cadre general -->
    <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Rattachement</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="user" class="nav-icon fas fa-expand"></span>
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

            <div class="form-group row">
                <label for="text" class="col-sm-2 col-form-label">Utilisateur(s)</label>
                <div class="col-sm-10">
                  <div class="input-group mb-3">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <select class="custom-select select2bs4 @error('user_id') is-invalid @enderror" name="user_id[]" multiple>
                        <option disabled> Sélectionner un ou des utilisateur(s)</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id}}"> {{ $user->nomuser }} {{ $user->prenomuser }} ({{ $user->libelleprofil}})</option>
                        @endforeach
                      </select>
                   </div>
                      @error('user_id')
                      <div class="invalid-feedback">
                          {{ $errors->first('user_id')}}
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
                      <select class="custom-select select2bs4  @error('metier_id') is-invalid @enderror" name="metier_id">
                        <option selected disabled> Sélectionner un métier</option>
                        <option value="0"> Aucun </option>
                        @foreach($metiers as $metier)
                        <option value="{{ $metier->id}}"> {{ $metier->libellemetier }}</option>
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
                <label for="text" class="col-sm-2 col-form-label">IFAD</label>
                <div class="col-sm-10">
                  <div class="input-group mb-3">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="nav-icon fas fa-school"></i></span>
                      </div>
                      <select class="custom-select select2bs4  @error('ifad_id') is-invalid @enderror" name="ifad_id">
                        <option selected disabled> Sélectionner un IFAD</option>
                        @foreach($ifads as $ifad)
                        <option value="{{ $ifad->id}}"> {{ $ifad->libelleifad }}</option>
                        @endforeach
                      </select>
                   </div>
                      @error('ifad_id')
                      <div class="invalid-feedback">
                          {{ $errors->first('ifad_id')}}
                      </div>
                    @enderror
                 </div>
              </div>



                </div>
            </div>
        </div>
    </div>
</div>
