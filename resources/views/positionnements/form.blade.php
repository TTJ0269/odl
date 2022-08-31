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
            @if($user->imageuser)
          <div class="col-12 col-sm-1">
            <div class="form-group">
                  <h6>
                  <img src="{{ asset('storage/image/' .$user->imageuser) }}" alt="user-ImageUser" class="img-thumbnail" style="width: 150px; height: 150px;">
                  </h6>
            </div>
          </div>
          @endif

            <div class="col-12 col-sm-7">
              <div class="form-group">
                    <h6><strong> {{$user->nomuser}} {{$user->prenomuser}}</strong></h6>
                    <h6><strong> </strong></h6>
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

                <input type="number" hidden value="{{$user->id}}" name="user_id"/>
                <input type="number" hidden value="{{$metiers->id}}" name="metier_id"/>
                <input type="text" hidden value="{{$metiers->libellemetier}}" name="metier_libelle"/>

                <div class="row">
                    @foreach($collections as $collection)

                    <div class="col-12 col-sm-12">
                        <div class="card card-info collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">{{$collection['focntion_libelle']}}</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="container-fluid">
                                    @foreach($collection['activites'] as $activite)
                                        <div class="col-12 col-sm-12">
                                            <div class="card card- collapsed-card">
                                                <div class="card-header">
                                                    <h3 class="card-title"> <strong style="color:rgb(12, 27, 72);"> {{$activite['activite_libelle']}} </strong></h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        @foreach($activite['taches'] as $tache)
                                                            <div class="row">
                                                                <div class="col-12 col-sm-10">
                                                                <label class="form-check-label"> <strong> <i>{{$tache->libelletache}}</i> </strong>  </label>
                                                                </div>
                                                                <div class="col-12 col-sm-2">
                                                                <!--input class="form-check-input" type="checkbox" value="{{$tache->id}}" name="tache_id_{{$tache->id}}"-->
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-danger d-inline">
                                                                        <input type="radio" id="radioDanger{{$tache->id}}" value="0" name="valeurpost_{{$tache->id}}" {{ $tache->valeurpost == "0" ? 'checked' : '' }} {{ $tache->valeurpost > "0" ? 'disabled' : '' }}>
                                                                        <label for="radioDanger{{$tache->id}}"></label>
                                                                        </div>
                                                                        <div class="icheck-orange d-inline">
                                                                        <input type="radio" id="radioOrange{{$tache->id}}" value="1" name="valeurpost_{{$tache->id}}" {{ $tache->valeurpost == "1" ? 'checked' : '' }} {{ $tache->valeurpost > "1" ? 'disabled' : '' }}>
                                                                        <label for="radioOrange{{$tache->id}}"></label>
                                                                        </div>
                                                                        <div class="icheck-purple d-inline">
                                                                        <input type="radio" id="radioPurple{{$tache->id}}" value="2" name="valeurpost_{{$tache->id}}" {{ $tache->valeurpost == "2" ? 'checked' : '' }} {{ $tache->valeurpost > "2" ? 'disabled' : '' }}>
                                                                        <label for="radioPurple{{$tache->id}}"></label>
                                                                        </div>
                                                                        <div class="icheck-primary d-inline">
                                                                        <input type="radio" id="radioPrimary{{$tache->id}}" value="3" name="valeurpost_{{$tache->id}}" {{ $tache->valeurpost == "3" ? 'checked' : '' }} {{ $tache->valeurpost > "3" ? 'disabled' : '' }}>
                                                                        <label for="radioPrimary{{$tache->id}}"></label>
                                                                        </div>
                                                                        <div class="icheck-success d-inline">
                                                                        <input type="radio" id="radioSuccess{{$tache->id}}" value="4" name="valeurpost_{{$tache->id}}" {{ $tache->valeurpost == "4" ? 'checked' : '' }} {{ $tache->valeurpost > "4" ? 'disabled' : '' }}>
                                                                        <label for="radioSuccess{{$tache->id}}"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p> <hr> </p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                   @endforeach
                </div>

</section>






