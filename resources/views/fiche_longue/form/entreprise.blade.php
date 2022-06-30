  <!-- cadre general -->
  <div class="card card-secondary direct-chat direct-chat-secondary">
    <div class="card-header">
    <h2 class="card-title">Entreprise</h2>
        <div class="card-tools">
            <span data-toggle="tooltip" title="user" class="nav-icon fas fa-building"></span>
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
                            <input type="text" class="form-control @error('nom_entreprise') is-invalid @enderror" name="nom_entreprise" placeholder="Rentrez le nom de l'entreprise..."  autofocus  required/>
                            @error('nom_entreprise')
                                <div class="invalid-feedback">
                                    {{ $errors->first('nom_entreprise')}}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="number" class="col-sm-2 col-form-label">Cellulaire</label>
                    <div class="col-sm-10">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                            </div>
                            <input type="number" class="form-control @error('tel_entreprise') is-invalid @enderror" name="tel_entreprise" placeholder="Rentrez le numéro de téléphone de l'entreprise..." autofocus  required/>
                            @error('tel_entreprise')
                                <div class="invalid-feedback">
                                    {{ $errors->first('tel_entreprise')}}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="text" class="col-sm-2 col-form-label">Mail de l'entreprise</label>
                    <div class="col-sm-10">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                            </div>
                            <input type="text" class="form-control @error('mail_entreprise') is-invalid @enderror" name="mail_entreprise" placeholder="Rentrez le mail de l'entreprise..."/>
                            @error('mail_entreprise')
                                <div class="invalid-feedback">
                                    {{ $errors->first('mail_entreprise')}}
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
