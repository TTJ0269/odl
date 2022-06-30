@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Association</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Association</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <!-- cadre general -->
<div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h4 class="card-title">Liste des associations</h4>
    <div class="card-tools">
      <span data-toggle="tooltip" title="user" class="nav-icon fas fa-paste"></span>
    </div>
  </div>
  <!-- /fin cadre -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-body">
                           <form action="{{ route('associations.update', ['association' => $association->id]) }}" method="POST" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                                <button type="submit" class="btn btn-danger my-3">Fin de l'association à un IFAD</button>
                            </form>
                            <hr>
                            <p><strong>Date début :</strong> {{$association->datedebut}}</p>
                            <p><strong>Date fin :</strong> {{$association->datefin}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
