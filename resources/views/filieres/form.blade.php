@csrf
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Filière</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Filière</li>
            </ol>
           </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>

 <!-- cadre general -->
 <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Filière</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="users" class="nav-icon fab fa-foursquare"></span>
    </div>
  </div>
  <!-- /fin cadre -->

    <!-- /.content-header -->
<div class="content">
    <div class="container-fluid">
    <hr>

    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">Métier</label>
        <div class="col-sm-10">
        <div class="input-group mb-3">
            <div class="input-group-append">
                <span class="input-group-text"><i class="nav-icon fas fa-chalkboard-teacher"></i></span>
            </div>
            <select class="custom-select select2bs4  @error('metier_id') is-invalid @enderror" name="metier_id">
                <option selected disabled> Sélectionner un metier</option>
                @foreach($metiers as $metier)
                <option value="{{ $metier->id }}" {{ $filiere->metier_id == $metier->id ? 'selected' : ''}}> {{ $metier->libellemetier }} ({{ $metier->ifad->libelleifad }})</option>
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
         <label for="text" class="col-sm-2 col-form-label">Libelle</label>
             <div class="col-sm-10">
                <div class="input-group mb-3">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="nav-icon fas fa-signature"></i></span>
                    </div>
                    <input type="text" class="form-control @error('libellefiliere') is-invalid @enderror" name="libellefiliere" placeholder="Rentrez le libelle..." value="{{ old('libellefiliere') ?? $filiere->libellefiliere }}" autofocus  required/>
                    @error('libellefiliere')
                        <div class="invalid-feedback">
                            {{ $errors->first('libellefiliere')}}
                        </div>
                    @enderror
             </div>
         </div>
     </div>

    </div>
</div>
