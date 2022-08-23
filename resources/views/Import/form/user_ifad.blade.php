    <div class="col-12 col-sm-12">
        <div class="card card-primary collapsed-card">
            <div class="card-header">
                <h3 class="card-title"> <a href="{{ route('referentiel_user')}}" class="float-left"><i class="fas fa-download"></i></a> Importation des apprenants </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">

                    <form action="{{ route('import_user_ifad_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">IFAD</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                <span class="input-group-text"><i class="nav-icon fas fa-school"></i></span>
                                </div>
                                <select class="custom-select select2bs4  @error('ifad_id') is-invalid @enderror" name="ifad_id" id="ifad">
                                    <option selected disabled>Sélectionner un IFAD</option>
                                    @foreach($ifads as $ifad)
                                    <option value="{{ $ifad->id}}"> {{ $ifad->libelleifad }}</option>
                                    @endforeach
                                </select>
                                @error('ifad_id')
                                <div class="invalid-feedback">
                                    {{ $errors->first('ifad_id')}}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
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

                        <div class="form-group row">
                        <label for="file" class="col-sm-2 col-form-label">Fichier</label>
                        <input type="file" name="file" class="@error('file') is-invalid @enderror" accept=".xlsx,.xls,.csv" id="validatedCustomFile">
                            @error('file')
                            <div class="invalid-feedback">
                                {{ $errors->first('file')}}
                            </div>
                            @enderror
                        </div>

                    <button type="submit" class="btn btn-primary my-2"><i class="fas fa-arrow-circle-down"></i><span> Import </span></button>
                    </form>

                </div>
            </div>
        </div>
    </div>
