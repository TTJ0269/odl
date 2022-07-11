@csrf
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Stage</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Stage</li>
            </ol>
           </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>

 <!-- cadre general -->
 <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Stage</h3>
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
        <label for="text" class="col-sm-2 col-form-label">Entreprise</label>
        <div class="col-sm-10">
          <div class="input-group mb-3">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-text-height"></i></span>
              </div>
              <select class="custom-select select2bs4  @error('entreprise_id') is-invalid @enderror" name="entreprise_id">
                 <option selected disabled>Sélectionner une entreprise</option>
                @foreach($entreprises as $entreprise)
                <option value="{{ $entreprise->id}}"> {{ $entreprise->libelleentreprise }}</option>
                @endforeach
              </select>
           </div>
              @error('entreprise_id')
              <div class="invalid-feedback">
                  {{ $errors->first('entreprise_id')}}
              </div>
            @enderror
         </div>
      </div>


      <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Apprenant(e)</label>
          <div class="col-sm-10">
              <div class="input-group mb-3">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                    <select class="custom-select select2bs4 @error('user_id') is-invalid @enderror" name="user_id">
                        <option selected disabled>Sélectionner un(e) apprenant(e)</option>
                        @foreach ($apprenants as $apprenant)
                        <option value="{{ $apprenant->id }}"> {{ $apprenant->nomuser }} {{ $apprenant->prenomuser }} </option>
                        @endforeach
                    </select>
              </div>
              @error('user_id')
              <div class="invalid-feedback">
                  {{ $errors->first('user_id')}}
              </div>
              @enderror
          </div>
      </div>

      <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">Date début</label>
        <div class="col-sm-10">
          <div class="input-group mb-3">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-audio-description"></i></span>
              </div>
              <input type="date" class="form-control @error('datedebut') is-invalid @enderror" name="datedebut" placeholder="datedebut" min='2022-01-01' max='2100-01-01' autofocus  required/>
              @error('datedebut')
              <div class="invalid-feedback">
                  {{ $errors->first('datedebut')}}
              </div>
              @enderror
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">Date Fin</label>
        <div class="col-sm-10">
          <div class="input-group mb-3">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-audio-description"></i></span>
              </div>
              <input type="date" class="form-control @error('datefin') is-invalid @enderror" name="datefin" placeholder="datefin" min='2022-01-01' max='2100-01-01' autofocus  required/>
              @error('datefin')
              <div class="invalid-feedback">
                  {{ $errors->first('datefin')}}
              </div>
              @enderror
          </div>
        </div>
      </div>

    </div>
</div>
