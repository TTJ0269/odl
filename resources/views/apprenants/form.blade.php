@csrf
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Apprenant(e)</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Apprenant(e)</li>
            </ol>
           </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>

    <!-- cadre general -->
    <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Apprenant(e)</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="user" class="nav-icon fas fa-user"></span>
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
                        <label for="text" class="col-sm-4 col-form-label">Nom</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                      <span class="input-group-text"><i class="nav-icon fas fa-signature"></i></span>
                                    </div>
                                   <input type="text" class="form-control @error('nomuser') is-invalid @enderror" name="nomuser" placeholder="Rentrez le nom de l'apprenant(e)..." value="{{ old('nomuser') ?? $apprenant->nomuser }}" autofocus  required/>
                                </div>
                                @error('nomuser')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nomuser')}}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                        <label for="text" class="col-sm-4 col-form-label">Prénom</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                      <span class="input-group-text"><i class="nav-icon fas fa-signature"></i></span>
                                    </div>
                                   <input type="text" class="form-control @error('prenomuser') is-invalid @enderror" name="prenomuser" placeholder="Rentrez le prenom de l'apprenant(e)..." value="{{ old('prenomuser') ?? $apprenant->prenomuser }}" autofocus  required/>
                                </div>
                            @error('prenomuser')
                                <div class="invalid-feedback">
                                    {{ $errors->first('prenomuser')}}
                                </div>
                            @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="text" class="col-sm-4 col-form-label">Login</label>
                                <div class="col-sm-10">
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                          <span class="input-group-text"><i class="nav-icon fas fa-signature"></i></span>
                                        </div>
                                       <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Rentrez le login de l'apprenant(e)..." value="{{ old('name') ?? $apprenant->name }}" autofocus  required/>
                                    </div>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name')}}
                                    </div>
                                @enderror
                                </div>
                        </div>

                        <div class="col-12 col-sm-6">
                        <label for="text" class="col-sm-4 col-form-label">Téléphone</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                      <span class="input-group-text"><i class="nav-icon fas fa-phone-alt"></i></span>
                                    </div>
                                   <input type="text" class="form-control @error('teluser') is-invalid @enderror" name="teluser" placeholder="Rentrez le tel de l'apprenant(e)..." value="{{ old('teluser') ?? $apprenant->teluser }}"/>
                                </div>
                                @error('teluser')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('teluser')}}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="text" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                          <span class="input-group-text"><i class="nav-icon fas fa-at"></i></span>
                                        </div>
                                           <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Rentrez email de l'apprenant(e)..." value="{{ old('email') ?? $apprenant->email }}"/>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email')}}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="text" class="col-sm-2 col-form-label">IFAD</label>
                                <div class="col-sm-10">
                                  <div class="input-group mb-3">
                                      <div class="input-group-append">
                                        <span class="input-group-text"><i class="nav-icon fas fa-school"></i></span>
                                      </div>
                                      <select class="custom-select select2bs4  @error('ifad_id') is-invalid @enderror" name="ifad_id" id="ifad">
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

                              <div class="col-12 col-sm-6">
                                <label for="text" class="col-sm-2 col-form-label">Classe</label>
                                <div class="col-sm-10">
                                  <div class="input-group mb-3">
                                      <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-text-height"></i></span>
                                      </div>
                                      <select class="custom-select select2bs4" name="classe_id" id="classe"></select>
                                   </div>
                                 </div>
                              </div>

                              <div class="col-12 col-sm-6">
                                <label for="text" class="col-sm-4 col-form-label">Numéro matricule</label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                              <span class="input-group-text"><i class="nav-icon fas fa-signature"></i></span>
                                            </div>
                                           <input type="text" class="form-control @error('numero_matricule') is-invalid @enderror" name="numero_matricule" placeholder="Rentrez le numéro matricule de l'apprenant(e)..." value="{{ old('numero_matricule') ?? $apprenant->numero_matricule }}"/>
                                        </div>
                                        @error('numero_matricule')
                                            <div class="invalid-feedback">
                                                {{ $errors->first('numero_matricule')}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                            <div class="col-12 col-sm-6">
                            <label for="text" class="col-sm-4 col-form-label">Image</label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="@error('image') is-invalid @enderror" id="validatedCustomFile" value="{{ old('image') ?? $apprenant->image }}">
                                        @error('image')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('image')}}
                                    </div>
                                    @enderror
                                    </div>
                                </div>
                            </div>

                            <!--div class="form-group row">
                            <label for="text" class="col-sm-4 col-form-label">Mot de passe</label>
                                <div class="col-sm-10">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Rentrez le mot de passe de l'utilisateur..." value="{{ old('password') ?? $apprenant->password }}" autofocus  required/>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password')}}
                                    </div>
                                @enderror
                                </div>
                            </div-->

                     </div>

                </div>
            </div>
        </div>
    </div>
</div>
