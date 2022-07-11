@csrf
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Positionnement</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Positionnement</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">

         <div class="row">
            <div class="col-12 col-sm-8">
              <div class="form-group">
              </div>
            </div>

            <div class="col-12 col-sm-4">
              <div class="form-group">
                  <div class="form-group clearfix">
                    <div class="icheck-danger">
                    <input type="radio" id="radioDangerGrille"  name="ValeurPost_Grille1" checked >
                    <label for="radioDangerGrille"> (0) Non observé </label>
                    </div>
                    <div class="icheck-orange">
                    <input type="radio" id="radioOrangeGrille" name="ValeurPost_Grille2" checked>
                    <label for="radioOrangeGrille"> (1) L'activité a été observée </label>
                    </div>
                    <div class="icheck-purple">
                    <input type="radio" id="radioPurpleGrille" name="ValeurPost_Grille3" checked>
                    <label for="radioPurpleGrille"> (2) L'activité a été réalisée avec de l'aide </label>
                    </div>
                    <div class="icheck-primary">
                    <input type="radio" id="radioPrimaryGrille" name="ValeurPost_Grille5" checked>
                    <label for="radioPrimaryGrille"> (3) L'activité a été réalisée en toute autonomie </label>
                    </div>
                    <div class="icheck-success">
                    <input type="radio" id="radioSuccessGrille" name="ValeurPost_Grille4" checked>
                    <label for="radioSuccessGrille"> (4) L'activité a été réalisée et maîtrisée </label>
                    </div>
                </div>
              </div>
            </div>
         </div>
         <a href="javascript:history.back();" class="btn btn-primary my-2"><i class="fas fa-angle-left"></i> Retour</a>

         <div class="row">
            <div class="col-12 col-sm-6">
                @include('positionnements.form.tuteur')
            </div>
            <div class="col-12 col-sm-6">
                @include('positionnements.form.entreprise')
            </div>
        </div>

                <!-- cadre general -->
        <div class="card card-secondary direct-chat direct-chat-secondary">
            <div class="card-header">
                <h3 class="card-title">Positionnement</h3>
                <div class="card-tools">
                  <span data-toggle="tooltip" title="user" class="nav-icon fas fa-signal"></span>
                </div>
            </div>

            <!-- /.content-header -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 my-2">

                            <table id="exa" class="table table-bordered table-striped">
                                <thead>
                                    <th scope="col">Numero</th>
                                    <th scope="col">Tâche</th>
                                    <th scope="col">Positionnement_tâche</th>
                                </thead>

                                <input type="number" hidden value="{{$users->id}}" name="user_id"/>

                                    <tbody>
                                    @foreach($collections as $key=>$collection)
                                    <tr>
                                    <th scope="row" style="color:rgb(55, 144, 246);"> {{++$key}} </th>
                                    <th scope="row" style="color:rgb(55, 144, 246);"> {{$collection['tache_libelle']}} </th>
                                    <th>
                                        <div class="form-group clearfix">
                                            <div class="icheck-danger d-inline">
                                            <input type="radio" id="radioDanger{{$collection['tache_id']}}" value="0" name="valeurpost_{{$collection['tache_id']}}" checked>
                                            <label for="radioDanger{{$collection['tache_id']}}"></label>
                                            </div>
                                            <div class="icheck-orange d-inline">
                                            <input type="radio" id="radioOrange{{$collection['tache_id']}}" value="1" name="valeurpost_{{$collection['tache_id']}}">
                                            <label for="radioOrange{{$collection['tache_id']}}"></label>
                                            </div>
                                            <div class="icheck-purple d-inline">
                                            <input type="radio" id="radioPurple{{$collection['tache_id']}}" value="2" name="valeurpost_{{$collection['tache_id']}}">
                                            <label for="radioPurple{{$collection['tache_id']}}"></label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                            <input type="radio" id="radioPrimary{{$collection['tache_id']}}" value="3" name="valeurpost_{{$collection['tache_id']}}">
                                            <label for="radioPrimary{{$collection['tache_id']}}"></label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                            <input type="radio" id="radioSuccess{{$collection['tache_id']}}" value="4" name="valeurpost_{{$collection['tache_id']}}">
                                            <label for="radioSuccess{{$collection['tache_id']}}"></label>
                                            </div>
                                        </div>
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
        <!-- /fin cadre -->

</section>
