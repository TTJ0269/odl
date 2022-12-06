@csrf
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Observation</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Observation</li>
            </ol>
           </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>
<a href="javascript:history.back();" class="btn btn-primary my-2"><i class="fas fa-angle-left"></i> Retour</a>
    <!-- cadre general -->
    <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Observation</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="user" class="nav-icon fas fa-comments"></span>
    </div>
  </div>
  <!-- /fin cadre -->

    <!-- /.content-header -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                @foreach ($users as $user)
                    <div class="text-center">
                       <h4> Observation de l'apprenant(e): {{ $user->nomuser }} {{ $user->prenomuser }}</h4>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fas fa-comments"></i></span>
                        </div>
                        <input type="number" hidden  name="user_id" value="{{$user->id}}">
                        <input type="text" hidden  name="user_name" value="{{ $user->nomuser }} {{ $user->prenomuser }}">
                        <textarea cols="10" class="form-control @error('descriptionobservation') is-invalid @enderror" name="descriptionobservation" placeholder="Rentrez une observation..." autofocus  required></textarea>
                        @error('descriptionobservation')
                            <div class="invalid-feedback">
                                {{ $errors->first('descriptionobservation')}}
                            </div>
                        @enderror
                    </div>
                @endforeach
           </div>
        </div>
    </div>
</div>
