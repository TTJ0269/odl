@extends('layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Apprenant</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Apprenant</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <a href="javascript:history.back();" class="btn btn-primary my-2"><i class="fas fa-angle-left"></i> Retour</a>
    <!-- cadre general -->
    <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Apprenant</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="user" class="nav-icon fas fa-signal"></span>
    </div>
  </div>
  <!-- /fin cadre -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-body">

                        <br>
                        <div class="text-center">
                            <h5 style="color:rgb(55, 144, 246);"> <strong> Sélectionner le métier et la classe de l'apprenant(e) puis appuyer sur le bouton valider </strong></h5>
                        </div>

                        <form action="{{ route('positionnement_classe_apprenant') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Métier</label>
                              <div class="col-sm-10">
                                  <div class="input-group mb-3">
                                      <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                      </div>
                                        <select class="custom-select select2bs4" name="metier_id" id="metier">
                                            <option selected disabled>Sélectionner un métier</option>
                                            @foreach ($metiers as $metier)
                                            <option value="{{ $metier->id }}"> {{ $metier->libellemetier }} ({{ $metier->ifad->libelleifad }}) </option>
                                            @endforeach
                                        </select>
                                  </div>
                              </div>
                          </div>

                          <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Classe</label>
                              <div class="col-sm-10">
                                  <div class="input-group mb-3">
                                      <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-book-open"></i></span>
                                      </div>
                                          <select class="custom-select select2bs4" name="classe_id" id="classe"></select>
                                  </div>
                              </div>
                          </div>

                          <div class="text-center">
                            <button type="submit" class="btn btn-primary my-5"> Valider </button>
                          </div>
                        </form>

                     </div>
                </div>
            </div>
         </div>
     </div>
@endsection
