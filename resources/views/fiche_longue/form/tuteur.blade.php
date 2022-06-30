  <!-- cadre general -->
  <div class="card card-secondary direct-chat direct-chat-secondary">
    <div class="card-header">
    <h3 class="card-title">Tuteur/Tutrice</h3>
        <div class="card-tools">
            <span data-toggle="tooltip" title="user" class="nav-icon fas fa-user"></span>
        </div>
    </div>

    <!-- /.content-header -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 my-2">

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
<!-- /fin cadre -->
