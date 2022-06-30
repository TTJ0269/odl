  <!-- cadre general -->
<div class="card card-secondary direct-chat direct-chat-secondary">
    <div class="card-header">
    <h3 class="card-title">Apprenant(e)</h3>
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
                            <input type="text" class="form-control @error('nom_apprenant') is-invalid @enderror" name="nom_apprenant" placeholder="Rentrez le nom de l'apprenant(e)..."  autofocus  required/>
                            @error('nom_apprenant')
                                <div class="invalid-feedback">
                                    {{ $errors->first('nom_apprenant')}}
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
                            <input type="text" class="form-control @error('prenom_apprenant') is-invalid @enderror" name="prenom_apprenant" placeholder="Rentrez le prénom de l'apprenant(e)..." autofocus  required/>
                            @error('prenom_apprenant')
                                <div class="invalid-feedback">
                                    {{ $errors->first('prenom_apprenant')}}
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
