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
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

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
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#livret" data-toggle="tab">Fiche de positionnement</a></li>
                </ul>
              </div><!-- /.card-header -->

              <div class="card-body">
                <div class="tab-content">

                  <div class="active tab-pane" id="livret">
                     <table id="exa" class="table table-bordered table-striped">
                      <thead>
                          <th scope="col">Numero</th>
                          <th scope="col">Compétence</th>
                      </thead>

                      <input type="number" hidden value="{{$classe_id}}" name="classe_id"/>
                      <input type="number" hidden value="{{$user_id}}" name="user_id"/>

                          <tbody>
                          @foreach($collections as $key=>$collection)
                          <tr>
                          <th scope="row" style="color:rgb(55, 144, 246);"> {{++$key}} </th>
                          <th scope="row" style="color:rgb(55, 144, 246);"> {{$collection[1]}} </th>
                          <tr>
                          <th>
                            <th scope="row">

                              <table id="ea" class="table table-bordered table-striped">
                              <thead>
                              <th scope="col">Activité</th>
                              <th scope="col">Positionnment_activité</th>
                              </thead>
                              <tbody>
                                  @foreach($collection[2] as $activite)
                                  <tr>
                                  <th scope="row"> {{$activite->libelleactivite}} </th>
                                  <th scope="row">
                                    <div class="form-group clearfix">
                                        <div class="icheck-danger d-inline">
                                        <input type="radio" id="radioDanger{{$activite->id}}" value="0" name="valeurpost_{{$activite->id}}" checked>
                                        <label for="radioDanger{{$activite->id}}"></label>
                                        </div>
                                        <div class="icheck-orange d-inline">
                                        <input type="radio" id="radioOrange{{$activite->id}}" value="1" name="valeurpost_{{$activite->id}}">
                                        <label for="radioOrange{{$activite->id}}"></label>
                                        </div>
                                        <div class="icheck-purple d-inline">
                                        <input type="radio" id="radioPurple{{$activite->id}}" value="2" name="valeurpost_{{$activite->id}}">
                                        <label for="radioPurple{{$activite->id}}"></label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary{{$activite->id}}" value="3" name="valeurpost_{{$activite->id}}">
                                        <label for="radioPrimary{{$activite->id}}"></label>
                                        </div>
                                        <div class="icheck-success d-inline">
                                        <input type="radio" id="radioSuccess{{$activite->id}}" value="4" name="valeurpost_{{$activite->id}}">
                                        <label for="radioSuccess{{$activite->id}}"></label>
                                        </div>
                                    </div>
                                  </th>
                                  </tr>
                                  @endforeach
                              </tbody>
                              </table>
                              </th>
                            </th>
                            </tr>
                          </tr>
                          @endforeach
                          </tbody>
                      </table>
                  </div>

                  <div class="tab-pane" id="fonction_typeactivite">

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
    </section>
