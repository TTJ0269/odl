@csrf
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tâche</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Tâche</li>
            </ol>
           </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>

    <!-- cadre general -->
    <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Tâche</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="user" class="nav-icon fas fa-paste"></span>
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
                <label for="text" class="col-sm-2 col-form-label">Activité</label>
                <div class="col-sm-10">
                  <div class="input-group mb-3">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-text-height"></i></span>
                      </div>
                      <select class="custom-select select2bs4 @error('activite_id') is-invalid @enderror" name="activite_id">
                        <option selected disabled> Sélectionner une activité</option>
                        @foreach($activites as $activite)
                        <option value="{{ $activite->id}}"> {{ $activite->libelleactivite }}</option>
                        @endforeach
                      </select>
                   </div>
                      @error('activite_id')
                      <div class="invalid-feedback">
                          {{ $errors->first('activite_id')}}
                      </div>
                    @enderror
                 </div>
              </div>

               <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Libelle</label>
                  <div class="col-sm-10">
                      <div class="input-group mb-3">
                          <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-tenge"></i></span>
                          </div>
                          <input type="text" onkeypress="return event.charCode != 39" class="form-control @error('libelletache') is-invalid @enderror" name="libelletache"  placeholder="Libelle" value="{{ old('libelletache') ?? $tach->libelletache }}" required autofocus/>
                          @error('libelletache')
                          <div class="invalid-feedback">
                              {{ $errors->first('libelletache')}}
                          </div>
                          @enderror
                      </div>
                  </div>
              </div>

              <div class="form-group row">
                <label for="text" class="col-sm-2 col-form-label">Identifiant</label>
                <div class="col-sm-10">
                  <div class="input-group mb-3">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-audio-description"></i></span>
                      </div>
                      <input type="text" class="form-control @error('identifianttache') is-invalid @enderror" name="identifianttache" placeholder="identifiant" value="{{ old('identifianttache') ?? $tach->identifianttache }}" autofocus  required/>
                      @error('identifianttache')
                      <div class="invalid-feedback">
                          {{ $errors->first('identifianttache')}}
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
