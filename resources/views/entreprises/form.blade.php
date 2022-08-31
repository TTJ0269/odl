@csrf
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Entreprise</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Entreprise</li>
            </ol>
           </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>

 <!-- cadre general -->
 <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Entreprise</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="users" class="nav-icon fas fa-users"></span>
    </div>
  </div>
  <!-- /fin cadre -->

    <!-- /.content-header -->
<div class="content">
    <div class="container-fluid">
       <hr>
       <div class="row">

        <div class="col-12 col-sm-6">
            <label for="text" class="col-sm-2 col-form-label">Nom</label>
                <div class="col-sm-10">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                          <span class="input-group-text"><i class="nav-icon fas fa-signature"></i></span>
                        </div>
                        <input type="text" class="form-control @error('libelleentreprise') is-invalid @enderror" name="libelleentreprise" placeholder="Rentrez le nom de l'entreprise..." value="{{ old('libelleentreprise') ?? $entreprise->libelleentreprise }}" autofocus  required/>
                        @error('libelleentreprise')
                            <div class="invalid-feedback">
                                {{ $errors->first('libelleentreprise')}}
                            </div>
                        @enderror
                 </div>
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <label for="text" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                          <span class="input-group-text"><i class="nav-icon fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control @error('emailentreprise') is-invalid @enderror" name="emailentreprise" placeholder="Rentrez email de l'entreprise..." value="{{ old('emailentreprise') ?? $entreprise->emailentreprise }}" required/>
                        @error('emailentreprise')
                            <div class="invalid-feedback">
                                {{ $errors->first('emailentreprise')}}
                            </div>
                        @enderror
                     </div>
                </div>
        </div>

        <div class="col-12 col-sm-6">
            <label for="text" class="col-sm-2 col-form-label">Téléphone</label>
                <div class="col-sm-10">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                          <span class="input-group-text"><i class="nav-icon fas fa-phone-alt"></i></span>
                        </div>
                        <input type="number" class="form-control @error('telentreprise') is-invalid @enderror" name="telentreprise" placeholder="Rentrez le tél de l'entreprise..." value="{{ old('telentreprise') ?? $entreprise->telentreprise }}"/>
                        @error('telentreprise')
                            <div class="invalid-feedback">
                                {{ $errors->first('telentreprise')}}
                            </div>
                        @enderror
                    </div>
                </div>
        </div>

        <div class="col-12 col-sm-6">
            <label for="text" class="col-sm-2 col-form-label">Adresse</label>
                <div class="col-sm-10">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                          <span class="input-group-text"><i class="nav-icon fas fa-map-marker-alt"></i></span>
                        </div>
                        <input type="text" class="form-control @error('adresseentreprise') is-invalid @enderror" name="adresseentreprise" placeholder="Rentrez l'adresse de l'entreprise..." value="{{ old('adresseentreprise') ?? $entreprise->adresseentreprise }}"/>
                        @error('adresseentreprise')
                            <div class="invalid-feedback">
                                {{ $errors->first('adresseentreprise')}}
                            </div>
                        @enderror
                     </div>
                </div>
        </div>

        <div class="col-12 col-sm-6">
            <label for="text" class="col-sm-4 col-form-label">Logo</label>
                <div class="col-sm-8">
                    <div class="custom-file">
                        <input type="file" name="logoentreprise" class="@error('logoentreprise') is-invalid @enderror" id="validatedCustomFile" value="{{ old('logoentreprise') ?? $entreprise->logoentreprise }}">
                        @error('logoentreprise')
                    <div class="invalid-feedback">
                        {{ $errors->first('logoentreprise')}}
                    </div>
                    @enderror
                    </div>
                </div>
        </div>

    </div>

    </div>
</div>
