<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{config('app.name', 'AED')}}</title>

 <!-- statistique -->
 <!--<link rel="stylesheet" type="text/css" href="{{ asset('css/mystyle.css') }}">-->

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('vendors/plugins/fontawesome-free/css/all.min.css') }}">

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('vendors/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('vendors/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('vendors/dist/css/adminlte.min.css') }}">


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- Select2 -->
  <!--link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /-->
  <link rel="stylesheet" href="{{ asset('vendors/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('vendors/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
</head>
<!-- <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"> -->
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>AIDE</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <!--li class="breadcrumb-item active">Aide</li-->
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>



      <!-- Main content -->
      <section class="content">


        <!-- Default box -->
        <div class="card card-solid">
          <div class="card-body">
            <div class="row">

              <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                <div class="row mt-4">
                    <nav class="w-100">
                      <div class="nav nav-tabs" id="profil-tab" role="tablist">
                        <a class="nav-item nav-link active" id="profil-apprenant-tab" data-toggle="tab" href="#profil-apprenant" role="tab" aria-controls="profil-apprenant" aria-selected="true">Apprenant</a>
                        <a class="nav-item nav-link" id="profil-ft-tab" data-toggle="tab" href="#profil-ft" role="tab" aria-controls="profil-ft" aria-selected="false">Formateur ou Tuteur en entreprise</a>
                        <a class="nav-item nav-link" id="profil-dg-tab" data-toggle="tab" href="#profil-dg" role="tab" aria-controls="profil-dg" aria-selected="false">DG IFAD</a>
                        <a class="nav-item nav-link" id="profil-rp-tab" data-toggle="tab" href="#profil-rp" role="tab" aria-controls="profil-rp" aria-selected="false">Responsable Pédagogique</a>
                      </div>
                    </nav>
                    <div class="tab-content p-3" id="nav-tabContent">
                       <div class="tab-pane fade show active" id="profil-apprenant" role="tabpanel" aria-labelledby="profil-apprenant-tab">
                            <div class="timeline timeline-inverse">
                            <div> <i class="fas fa-book-open bg-success"></i>
                                <div class="timeline-item">
                                <!--span class="time"><i class="far fa-clock"></i> 12:05</span-->
                                <h3 class="timeline-header" style="color: rgb(39, 71, 166)">Consulter la fiche de positionnement</h3>
                                    <div class="timeline-body">
                                    <h6> &#128413; Cliquer sur le bouton Fiche de positionnement </h6>
                                    <h6> &#128413; Rechercher l'apprenant(e) et choisissez sa fiche </h6>
                                    </div>
                                </div>
                            </div>
                            <div> <i class="fas fa-book bg-danger"></i></div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="profil-ft" role="tabpanel" aria-labelledby="profil-ft-tab">
                        <div class="timeline timeline-inverse">
                            <div> <i class="fas fa-poll bg-primary"></i>
                                <div class="timeline-item">
                                <!--span class="time"><i class="far fa-clock"></i> 12:05</span-->

                               <h3 class="timeline-header" style="color: rgb(39, 71, 166)"> Positionner un apprenant</h3>
                                    <div class="timeline-body">
                                    <h6> &#128413; Séléctionner la filière ainsi que la classe de l'apprenant(e)</h6>
                                    <h6> &#128413; Chosir l'apprenant(e) dans la liste </h6>
                                    <h6> &#128413; Positionner l'apprenant(e) selon les différentes activités qui lui sont confiées </h6>
                                    </div>
                                </div>
                            </div>


                            <div> <i class="fas fa-book-open bg-success"></i>
                            <div class="timeline-item">
                                <!--span class="time"><i class="far fa-clock"></i> 12:05</span-->
                                <h3 class="timeline-header" style="color: rgb(39, 71, 166)">Consulter de la fiche de positionnement</h3>
                                    <div class="timeline-body">
                                    <h6> &#128413; Rechercher l'apprenant(e) et choisissez sa fiche </h6>
                                    <h6> &#128413; Visualiser la fiche de positionnement de l'apprenant(e) </h6>
                                    <h6> &#128413; Visualiser les radars de positionnement de l'apprenant(e) </h6>
                                    </div>
                                </div>
                            </div>

                            <div> <i class="fas fa-comments bg-warning"></i>
                            <div class="timeline-item">
                                <!--span class="time"><i class="far fa-clock"></i> 12:05</span-->
                                <h3 class="timeline-header" style="color: rgb(39, 71, 166)">Faire des observations</h3>
                                    <div class="timeline-body">
                                   <h6> &#128413; Séléctionner la filière ainsi que la classe de l'apprenant(e) </h6>
                                   <h6> &#128413; Choisir l'apprenant(e) dans la liste et faire une observation </h6>
                                    </div>
                                </div>
                            </div>

                            <div> <i class="fas fa-comments bg-warning"></i>
                                <div class="timeline-item">
                                <!--span class="time"><i class="far fa-clock"></i> 12:05</span-->
                                <h3 class="timeline-header" style="color: rgb(39, 71, 166)">Consulter les observations déja faites</h3>
                                    <div class="timeline-body">
                                    <h6> &#128413; Choisir l'apprenant(e) dans la liste </h6>
                                    <h6> &#128413; Visualiser les observations faites </h6>
                                    </div>
                                </div>
                            </div>
                            <div> <i class="fas fa-book bg-danger"></i></div>
                        </div>

                      </div>
                      <div class="tab-pane fade" id="profil-dg" role="tabpanel" aria-labelledby="profil-dg-tab">
                        <div class="timeline timeline-inverse">
                            <div> <i class="fas fa-book-open bg-success"></i>
                            <div class="timeline-item">
                                <!--span class="time"><i class="far fa-clock"></i> 12:05</span-->
                                <h3 class="timeline-header" style="color: rgb(39, 71, 166)">Consulter de la fiche de positionnement</h3>
                                    <div class="timeline-body">
                                    <h6> &#128413; Rechercher l'apprenant(e) et choisissez sa fiche </h6>
                                    <h6> &#128413; Visualiser la fiche de positionnement de l'apprenant(e) </h6>
                                    <h6> &#128413; Visualiser les radars de positionnement de l'apprenant(e) </h6>
                                    </div>
                                </div>
                            </div>

                            <div> <i class="fas fa-comments bg-warning"></i>
                                <div class="timeline-item">
                                <!--span class="time"><i class="far fa-clock"></i> 12:05</span-->
                                <h3 class="timeline-header" style="color: rgb(39, 71, 166)">Consulter les observations faites</h3>
                                    <div class="timeline-body">
                                    <h6> &#128413; Choisir l'apprenant(e) dans la liste </h6>
                                    <h6> &#128413; Visualiser les observations </h6>
                                    </div>
                                </div>
                            </div>
                            <div> <i class="fas fa-book bg-danger"></i></div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="profil-rp" role="tabpanel" aria-labelledby="profil-rp-tab">
                        <div class="timeline timeline-inverse">
                            <div> <i class="fas fa-book-open bg-success"></i>
                                <div class="timeline-item">
                                    <!--span class="time"><i class="far fa-clock"></i> 12:05</span-->
                                    <h3 class="timeline-header" style="color: rgb(39, 71, 166)">Consulter de la fiche de positionnement</h3>
                                        <div class="timeline-body">
                                        <h6> &#128413; Rechercher l'apprenant(e) et choisissez sa fiche </h6>
                                        <h6> &#128413; Visualiser la fiche de positionnement de l'apprenant(e) </h6>
                                        <h6> &#128413; Visualiser les radars de positionnement de l'apprenant(e) </h6>
                                        </div>
                                    </div>
                                </div>

                                <div> <i class="fas fa-comments bg-warning"></i>
                                    <div class="timeline-item">
                                    <!--span class="time"><i class="far fa-clock"></i> 12:05</span-->
                                    <h3 class="timeline-header" style="color: rgb(39, 71, 166)">Consulter les observations faites</h3>
                                        <div class="timeline-body">
                                        <h6> &#128413; Choisir l'apprenant(e) dans la liste </h6>
                                        <h6> &#128413; Visualiser les observations faites </h6>
                                        </div>
                                    </div>
                                </div>
                            <div> <i class="fas fa-book bg-danger"></i></div>
                        </div>
                      </div>

                    </div>
                  </div>
              </div>

              <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                <h3 class="text-primary"><i class="fas fa-paint-brush"></i> Outil de Liaison</h3>
                <p class="text-muted">
                    Cet outil est réalisé dans le cadre de la mise en œuvre de l'alternance qui repose sur la démarche des compétences dans les IFAD.
                    Il permet de positionner les apprenants dans l'acquisitions des compétences à l'IFAD et en entreprise.
                </p>
                <br>

                <h5 class="mt-5 text-muted"> Document de guide</h5>
                <ul class="list-unstyled">
                 <!-- <li>
                    <a href="{{ route('guide_utilisation_docx') }}" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> guide d'utilisation.docx</a>
                  </li> -->
                  <li>
                    <a href="{{ route('guide_utilisation_pdf')}} " class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> guide d'utilisation.pdf</a>
                  </li>
                </ul>
                <div class="text-center mt-5 mb-3">
                  <a href="{{ route('index') }}" class="btn btn-sm btn-primary"><i class="fas fa-angle-left"></i> Retour</a>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->

</body>
</html>

