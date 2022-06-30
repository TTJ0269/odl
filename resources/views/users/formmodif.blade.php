@csrf
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Utilisateur</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Utilisateur</li>
            </ol>
           </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>

    <!-- cadre general -->
    <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Utilisateur</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="user" class="nav-icon fas fa-user"></span>
    </div>
  </div>
  <!-- /fin cadre -->

    <!-- /.content-header -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                          @if (session()->has('messagealert'))
                          <div class="alert alert-danger" role="alert">
                          {{ session()->get('messagealert') }}
                          </div>
                          @endif
               <div class="content">
                     <hr>
                <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Nom de connexion</label>
                            <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Rentrez le nom utilisateur de connexion..." value="{{ old('name') ?? $user->name }}" autofocus  required/>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $errors->first('name')}}
                            </div>
                        @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Nom</label>
                            <div class="col-sm-10">
                        <input type="text" class="form-control @error('nomuser') is-invalid @enderror" name="nomuser" placeholder="Rentrez le nom de l'utilisateur..." value="{{ old('nomuser') ?? $user->nomuser }}" autofocus  required/>
                        @error('nomuser')
                            <div class="invalid-feedback">
                                {{ $errors->first('nomuser')}}
                            </div>
                        @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Prénom</label>
                            <div class="col-sm-10">
                        <input type="text" class="form-control @error('prenomuser') is-invalid @enderror" name="prenomuser" placeholder="Rentrez le prenom de l'utilisateur..." value="{{ old('prenomuser') ?? $user->prenomuser }}" autofocus  required/>
                        @error('prenomuser')
                            <div class="invalid-feedback">
                                {{ $errors->first('prenomuser')}}
                            </div>
                        @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Téléphone</label>
                            <div class="col-sm-10">
                        <input type="text" class="form-control @error('teluser') is-invalid @enderror" name="teluser" placeholder="Rentrez le tel de l'utilisateur..." value="{{ old('teluser') ?? $user->teluser }}" autofocus  required/>
                        @error('teluser')
                            <div class="invalid-feedback">
                                {{ $errors->first('teluser')}}
                            </div>
                        @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Rentrez email de l'utilisateur..." value="{{ old('email') ?? $user->email }}" autofocus  required/>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $errors->first('email')}}
                            </div>
                        @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Profil</label>
                            <div class="col-sm-10">
                        <select class="custom-select @error('profil_id') is-invalid @enderror" name="profil_id">
                                @foreach($profils as $profil)
                            <option value="{{ $profil->id}}" {{ $user->profil_id = $profil->id ? 'selected' : ''}}> {{ $profil->libelleprofil }} </option>
                            @endforeach
                        </select>
                        @error('profil_id')
                            <div class="invalid-feedback">
                                {{ $errors->first('profil_id')}}
                            </div>
                        @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
