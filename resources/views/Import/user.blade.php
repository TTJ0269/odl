@extends('layouts.app')

@section('content')

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
                <div class="content">
                      <br>

                      @if ($errors->any())
                        <h6 style="color:red"> Erreur dans le fichier Excel</h6>
                        <ol>
                            @foreach ($errors->all() as $error)
                              <li>{{$error}}</li>
                            @endforeach
                        </ol>
                      @endif

                    <form action="{{ route('import_user_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <!--div class="col-12 col-sm-6">
                            <label for="text">IFAD</label>
                                  <select class="custom-select select2bs4  @error('ifad_id') is-invalid @enderror" name="ifad_id">
                                     <option selected disabled>Sélectionner un IFAD</option>
                                    @foreach($ifads as $ifad)
                                    <option value="{{ $ifad->id}}"> {{ $ifad->libelleifad }}</option>
                                    @endforeach
                                  </select>
                                  @error('ifad_id')
                                  <div class="invalid-feedback">
                                      {{ $errors->first('ifad_id')}}
                                  </div>
                                @enderror
                          </div-->

                            <div class="col-12 col-sm-6">
                            <label for="file">Fichier</label>
                            <input type="file" name="file" class="@error('file') is-invalid @enderror" accept=".xlsx,.xls,.csv" id="validatedCustomFile">
                                @error('file')
                                <div class="invalid-feedback">
                                    {{ $errors->first('file')}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary my-3">Import</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
