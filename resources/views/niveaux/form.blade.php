@csrf
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Niveau</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Niveau</li>
            </ol>
           </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>

 <!-- cadre general -->
 <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Niveau</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="classe" class="nav-icon fas fa-sort-amount-up-alt"></span>
    </div>
  </div>
  <!-- /fin cadre -->

    <!-- /.content-header -->
<div class="content">
    <div class="container-fluid">
    <hr>

      <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">Libelle</label>
            <div class="col-sm-10">
              <div class="input-group mb-3">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="nav-icon fas fa-signature"></i></span>
                  </div>
                  <input type="text" class="form-control @error('libelleniveau') is-invalid @enderror" name="libelleniveau" placeholder="Rentrez le libelle..." value="{{ old('libelleniveau') ?? $niveau->libelleniveau }}" autofocus  required/>
                  @error('libelleniveau')
                      <div class="invalid-feedback">
                          {{ $errors->first('libelleniveau')}}
                      </div>
                  @enderror
              </div>
          </div>
      </div>

    </div>
</div>
