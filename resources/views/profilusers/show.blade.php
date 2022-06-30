@extends('layouts.app')

@section('content')

     <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Profil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">

              @foreach($users as $user)
                <form class="form-horizontal" action="{{ route('profilphotochange') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="number" hidden  name="id" value="{{$user->id}}" >
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('storage/image/' .$user->imageuser) }}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$user->nomuser}}</h3>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Prénom</b> <a class="float-right">{{$user->prenomuser}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Téléphone</b> <a class="float-right">{{$user->teluser}}</a>
                  </li>
                </ul>

                <div class="form-group my-3">
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="validatedCustomFile"/>
                            <label class="btn btn-primary btn-block" for="validatedCustomFile"> Changer la photo</label>
                            @error('image')
                        <div class="invalid-feedback">
                            {{ $errors->first('image')}}
                        </div>
                        @enderror
                        </div>
                  </div>

                <button type="submit" class="btn btn-success btn-block">Valider</button>
              </div>
            </div>
            </form>
            @endforeach
          </div>


          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Nom & Email</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Mot de passe</a></li>
                </ul>
              </div><!-- /.card-header -->

              <!-- Debut Activite -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">

                     @foreach($users as $user)
                      <form class="form-horizontal" action="{{ route('profilemailchange') }}" method="POST" enctype="multipart/form-data">
                         @csrf
                         <input type="number" hidden  name="id" value="{{$user->id}}">
                        <div class="form-group row">
                          <label for="name" class="col-sm-2 col-form-label">Login</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"  placeholder="Nom de connexion" value="{{ old('name') ?? $user->name }}" autofocus  required/>
                              @error('name')
                              <div class="invalid-feedback">
                                  {{ $errors->first('name')}}
                              </div>
                              @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="email" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') ?? $user->email }}" autofocus  required/>
                            @error('email')
                              <div class="invalid-feedback">
                                  {{ $errors->first('email')}}
                              </div>
                              @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Sauvegarder</button>
                          </div>
                        </div>
                      </form>
                     @endforeach

                  </div>
             <!-- Fin Activite -->


                  <div class="tab-pane" id="settings">
                  @foreach($users as $user)
                      <form class="form-horizontal" action="{{ route('profilpasswordchange') }}" method="POST" enctype="multipart/form-data">
                         @csrf
                         <input type="number" hidden  name="id" value="{{$user->id}}" >
                         <!--<div class="form-group row">
                          <label for="lastpassword" class="col-sm-3 col-form-label"> Ancien Mot de passe</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control @error('lastpassword') is-invalid @enderror" name="lastpassword"  placeholder="Ancien mot de passe" autofocus  required/>
                              @error('lastpassword')
                              <div class="invalid-feedback">
                                  {{ $errors->first('lastpassword')}}
                              </div>
                              @enderror
                          </div>
                        </div>-->

                        <div class="form-group row">
                          <label for="password" class="col-sm-3 col-form-label"> Nouveau Mot de passe</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"  placeholder="Nouveau mot de passe" autofocus  required/>
                              @error('password')
                              <div class="invalid-feedback">
                                  {{ $errors->first('password')}}
                              </div>
                              @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="confirmepassword" class="col-sm-3 col-form-label">Confirmation</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control @error('confirmepassword') is-invalid @enderror" name="confirmepassword" placeholder="Confirmation" autofocus  required/>
                            @error('confirmepassword')
                              <div class="invalid-feedback">
                                  {{ $errors->first('confirmepassword')}}
                              </div>
                              @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-3 col-sm-9">
                            <button type="submit" class="btn btn-danger">Sauvegarder</button>
                          </div>
                        </div>
                      </form>
                      @endforeach
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->


@endsection
