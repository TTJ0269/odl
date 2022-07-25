@csrf
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Métier</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Métier</li>
            </ol>
           </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>

 <!-- cadre general -->
 <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Métier</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="users" class="nav-icon fas fa-users"></span>
    </div>
  </div>
  <!-- /fin cadre -->

    <!-- /.content-header -->
<div class="content">
    <div class="container-fluid">
    <hr>

    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">IFAD</label>
        <div class="col-sm-10">
          <div class="input-group mb-3">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-school"></i></span>
              </div>
              <select class="custom-select select2bs4  @error('ifad_id') is-invalid @enderror" name="ifad_id">
                 <option selected disabled>Sélectionner un IFAD</option>
                @foreach($ifads as $ifad)
                <option value="{{ $ifad->id}}" {{ $metier->ifad_id == $ifad->id ? 'selected' : ''}}> {{ $ifad->libelleifad }}</option>
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

    <div class="form-group row">
         <label for="text" class="col-sm-2 col-form-label">Libelle</label>
             <div class="col-sm-10">
                <div class="input-group mb-3">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="nav-icon fas fa-signature"></i></span>
                    </div>
                    <input type="text" class="form-control @error('libellemetier') is-invalid @enderror" name="libellemetier" placeholder="Rentrez le libelle..." value="{{ old('libellemetier') ?? $metier->libellemetier }}" autofocus  required/>
                    @error('libellemetier')
                        <div class="invalid-feedback">
                            {{ $errors->first('libellemetier')}}
                        </div>
                    @enderror
             </div>
         </div>
     </div>

    </div>
</div>
