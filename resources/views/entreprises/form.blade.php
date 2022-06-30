@csrf
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Entreprise</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Entreprise</li>
            </ol>
           </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>

 <!-- cadre general -->
 <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Entreprise</h3>
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
            <label for="text" class="col-sm-2 col-form-label">Libelle</label>
                <div class="col-sm-10">
            <input type="text" class="form-control @error('libelleentreprise') is-invalid @enderror" name="libelleentreprise" placeholder="Rentrez le libelle..." value="{{ old('libelleentreprise') ?? $entreprise->libelleentreprise }}" autofocus  required/>
            @error('libelleentreprise')
                <div class="invalid-feedback">
                    {{ $errors->first('libelleentreprise')}}
                </div>
            @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="text" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                <input type="email" class="form-control @error('emailentreprise') is-invalid @enderror" name="emailentreprise" placeholder="Rentrez email de l'entreprise..." value="{{ old('emailentreprise') ?? $entreprise->emailentreprise }}"/>
                @error('emailentreprise')
                    <div class="invalid-feedback">
                        {{ $errors->first('emailentreprise')}}
                    </div>
                @enderror
                </div>
        </div>

        <div class="form-group row">
            <label for="text" class="col-sm-2 col-form-label">Téléphone</label>
                <div class="col-sm-10">
                <input type="number" class="form-control @error('telentreprise') is-invalid @enderror" name="telentreprise" placeholder="Rentrez le tél de l'entreprise..." value="{{ old('telentreprise') ?? $entreprise->telentreprise }}"/>
                @error('telentreprise')
                    <div class="invalid-feedback">
                        {{ $errors->first('telentreprise')}}
                    </div>
                @enderror
                </div>
        </div>
    </div>
</div>
