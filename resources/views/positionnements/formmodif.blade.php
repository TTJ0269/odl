@csrf
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Positionnement</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Positionnement</li>
            </ol>
           </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>

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
                    <label for="radioDangerGrille">(0) Non observé </label>
                    </div>
                    <div class="icheck-orange">
                    <input type="radio" id="radioOrangeGrille" name="ValeurPost_Grille2" checked>
                    <label for="radioOrangeGrille">(1) L'activité a été observée </label>
                    </div>
                    <div class="icheck-purple">
                    <input type="radio" id="radioPurpleGrille" name="ValeurPost_Grille3" checked>
                    <label for="radioPurpleGrille">(2) L'activité a été réalisée avec de l'aide </label>
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

    <!-- cadre general -->
    <div class="card card-secondary direct-chat direct-chat-secondary">
  <div class="card-header">
    <h3 class="card-title">Modification du positionnement de l'activité: {{ $activite->libelleactivite }}</h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="user" class="nav-icon fas fa-copy"></span>
    </div>
  </div>
  <!-- /fin cadre -->

    <!-- /.content-header -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

               <div class="content">
                      <hr>
                 <input type="number" hidden  name="fiche_id" value="{{$activite->fiche_positionnement_id}}" >
               <div class="form-group row">
                      <label for="text" class="col-sm-2 col-form-label">Activité</label>
                     <div class="col-sm-10">
                    <input type="text" class="form-control @error('libelleactivite') is-invalid @enderror" name="libelleactivite" placeholder="Rentrez le libelle..." value="{{ $activite->libelleactivite }}" disabled/>
                    @error('libelleactivite')
                        <div class="invalid-feedback">
                            {{ $errors->first('libelleactivite')}}
                        </div>
                    @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="text" class="col-sm-2 col-form-label">Positionnement</label>
                      <div class="form-group clearfix">
                        <div class="icheck-danger d-inline">
                        <input type="radio" id="radioDanger" value="0" name="valeurpost" checked>
                        <label for="radioDanger"></label>
                        </div>
                        <div class="icheck-orange d-inline">
                        <input type="radio" id="radioOrange" value="1" name="valeurpost">
                        <label for="radioOrange"></label>
                        </div>
                        <div class="icheck-purple d-inline">
                        <input type="radio" id="radioPurple" value="2" name="valeurpost">
                        <label for="radioPurple"></label>
                        </div>
                        <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary" value="3" name="valeurpost">
                        <label for="radioPrimary"></label>
                        </div>
                        <div class="icheck-success d-inline">
                        <input type="radio" id="radioSuccess" value="4" name="valeurpost">
                        <label for="radioSuccess"></label>
                        </div>
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
