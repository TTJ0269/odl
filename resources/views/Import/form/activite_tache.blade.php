<div class="col-12 col-sm-12">
    <div class="card card-primary collapsed-card">
        <div class="card-header">
            <h3 class="card-title"> <a href="{{ route('referentiel_metier')}}" class="float-left"><i class="fas fa-download"></i></a> Importation Activité & Tâche</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid">

                <form action="{{ route('import_activite_tache_store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <label for="text" class="col-sm-2 col-form-label">Fonction</label>
                    <div class="col-sm-10">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                            <span class="input-group-text"><i class="nav-icon fas fa-bookmark"></i></span>
                            </div>
                            <select class="custom-select select2bs4  @error('groupe_activite_id') is-invalid @enderror" name="groupe_activite_id">
                                <option selected disabled>Sélectionner une fonction</option>
                                @foreach($groupe_activites as $groupe_activite)
                                <option value="{{ $groupe_activite->id}}"> {{ $groupe_activite->libellegroupe }} ({{ $groupe_activite->filiere->libellefiliere }} {{ $groupe_activite->filiere->metier->ifad->libelleifad }} )</option>
                                @endforeach
                            </select>
                            @error('groupe_activite_id')
                            <div class="invalid-feedback">
                                {{ $errors->first('groupe_activite_id')}}
                            </div>
                            @enderror
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
