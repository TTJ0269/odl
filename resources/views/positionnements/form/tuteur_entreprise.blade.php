  <!-- cadre general -->
  <div class="card card-secondary direct-chat direct-chat-secondary">
    <div class="card-header">
    <h3 class="card-title">Tuteur/Tutrice & Entreprise</h3>
        <div class="card-tools">
            <span data-toggle="tooltip" title="user" class="nav-icon fas fa-user"></span> /
            <span data-toggle="tooltip" title="user" class="nav-icon fas fa-building"></span>
        </div>
    </div>

    <!-- /.content-header -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 my-2">

            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group row">
                            <label for="text" class="col-sm-2 col-form-label">Nom</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                </div>
                                <input type="text" class="form-control @error('nom_tuteur') is-invalid @enderror" name="nom_tuteur" placeholder="Rentrez le nom du tuteur ou tutrice..."  autofocus  required/>
                                @error('nom_tuteur')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nom_tuteur')}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <div class="form-group row">
                        <label for="number" class="col-sm-2 col-form-label">Cellulaire de l'entreprise</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                </div>
                                <input type="number" class="form-control @error('tel_entreprise') is-invalid @enderror" name="tel_entreprise" placeholder="Rentrez le numéro de téléphone de l'entreprise..."/>
                                @error('tel_entreprise')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('tel_entreprise')}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Prénom</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                </div>
                                <input type="text" class="form-control @error('prenom_tuteur') is-invalid @enderror" name="prenom_tuteur" placeholder="Rentrez le prénom du tuteur ou tutrice..." autofocus  required/>
                                @error('prenom_tuteur')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('prenom_tuteur')}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Adresse de l'entreprise</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                </div>
                                <input type="text" class="form-control @error('adresse_entreprise') is-invalid @enderror" name="adresse_entreprise" placeholder="Rentrez l'adresse de l'entreprise..."/>
                                @error('adresse_entreprise')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('adresse_entreprise')}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <div class="form-group row">
                        <label for="number" class="col-sm-2 col-form-label">Numéro de Téléphone</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                </div>
                                <input type="number" class="form-control @error('tel_tuteur') is-invalid @enderror" name="tel_tuteur" placeholder="Rentrez le numéro de téléphone du tuteur ou tutrice..." autofocus  required/>
                                @error('tel_tuteur')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('tel_tuteur')}}
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
</div>
<!-- /fin cadre -->
