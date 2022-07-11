@csrf
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Fiche de positionnement</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Fiche de positionnement</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

       <div class="row">
            <div class="col-12 col-sm-8">
              <div class="form-group">
              </div>
            </div>

            <div class="col-12 col-sm-4">
              <div class="form-group">
                  <div class="form-group clearfix">
                    <h6><strong> (0) Non observé </strong></h6>
                    <h6><strong> (1) L'activité a été observée </strong></h6>
                    <h6><strong> (2) L'activité a été réalisée avec de l'aide </strong></h6>
                    <h6><strong> (3) L'activité a été réalisée en toute autonomie </strong></h6>
                    <h6><strong> (4) L'activité a été réalisée et maîtrisée </strong></h6>
                 </div>
              </div>
            </div>
         </div>
         <!-- cadre general -->
<div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Modification de la {{ $fiche_positionnement->libellefiche }}</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="user" class="nav-icon fas fa-book-open"></span>
    </div>
  </div>
  <!-- /fin cadre -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-body">
                            <!--<form action="{{ route('fiche_positionnements.destroy', ['fiche_positionnement' => $fiche_positionnement->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form> -->
                            <table id="#" class="table table-bordered table-striped">
                                  <hr>
                                <thead>
                                    <th scope="col">Numéro</th>
                                    <th scope="col">Compétence</th>
                                    <th scope="col">Activité et positionnement</th>
                                </thead>

                                    <tbody>
                                    @foreach ($collections as $key=>$collection)
                                    <tr>
                                    <th scope="row"> {{$key++}} </th>
                                    <th scope="row"> {{$collection['activite_libelle']}}</th>
                                    <th scope="row">
                                            <table id="#" class="table table-bordered table-hover">
                                              <thead>
                                                  <th scope="col" style="color:rgb(55, 144, 246);" class="col-12 col-sm-10">Activité</th>
                                                  <th scope="col" style="color:rgb(55, 144, 246);" class="col-12 col-sm-2">Position</th>
                                              </thead>

                                              <tbody>
                                                 @foreach ($collection['taches'] as $tache_positionnement)
                                                  <tr>
                                                    <th scope="row"> {{$tache_positionnement->libelletache}} </th>
                                                    <th scope="row">
                                                      <div class="col-12">
                                                        <select class="form-control" name="positionnement_{{$tache_positionnement->id}}" id="tache_positionnement">
                                                            <option value="0" {{ $tache_positionnement->valeurpost == "0" ? 'selected' : '' }}> 0 </option>
                                                            <option value="1" {{ $tache_positionnement->valeurpost == "1" ? 'selected' : '' }}> 1 </option>
                                                            <option value="2" {{ $tache_positionnement->valeurpost == "2" ? 'selected' : '' }}> 2 </option>
                                                            <option value="3" {{ $tache_positionnement->valeurpost == "3" ? 'selected' : '' }}> 3 </option>
                                                            <option value="4" {{ $tache_positionnement->valeurpost == "4" ? 'selected' : '' }}> 4 </option>
                                                          </select>
                                                      </div>
                                                    </th>
                                                  </tr>
                                                  @endforeach
                                              </tbody>
                                           </table>
                                    </th>
                                    </tr>
                                    @endforeach
                                    </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
