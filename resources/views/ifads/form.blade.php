@csrf
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">IFAD</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">IFAD</li>
            </ol>
           </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>

    <!-- cadre general -->
    <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">IFAD</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="user" class="nav-icon fas fa-school"></span>
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
                <div class="form-group row">
                      <label for="text" class="col-sm-2 col-form-label">Libelle</label>
                          <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                  <span class="input-group-text"><i class="nav-icon fas fa-signature"></i></span>
                                </div>
                                <input type="text" class="form-control @error('libelleifad') is-invalid @enderror" name="libelleifad" placeholder="Rentrez le libelle..." value="{{ old('libelleifad') ?? $ifad->libelleifad }}" autofocus  required/>
                                @error('libelleifad')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('libelleifad')}}
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
