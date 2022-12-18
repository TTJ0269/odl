<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{config('app.name', 'AED')}}</title>

 <!-- statistique -->
 <!--<link rel="stylesheet" type="text/css" href="{{ asset('css/mystyle.css') }}">-->
  <link rel="stylesheet" href="{{ asset('css/statistiquechart.css') }}"
 integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w=="
 crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('vendors/plugins/fontawesome-free/css/all.min.css') }}">

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('vendors/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('vendors/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('vendors/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('vendors/dist/css/adminlte.min.css') }}">

  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('vendors/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <script src="{{ asset('assets/js/pdfmake.min.js') }}"></script>
 	<script src="{{ asset('assets/js/vfs.fonts.js') }}"></script>

  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ asset('vendors/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
</head>
<!-- <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"> -->
<body  class="hold-transition @if(Auth::user()->preference->last()) {{Auth::user()->preference->last()->center}} @else '' @endif sidebar-mini layout-fixed">
<div class="wrapper">

<!-- Preloader -->
 <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="#" alt="" height="200" width="400">
  </div> -->

<!--  1.  Top Menu-->
@include('layouts.menu.topmenu')
<!--  2.  Left Menu-->
@include('layouts.menu.leftmenu')
<!--  3.  Main Content (Body) -->

  <div class="content-wrapper">
    <!-- Main content -->
                          @if (session()->has('message'))
                          <div class="btn btn-success btn-block" role="alert">
                          {{ session()->get('message') }}
                          </div>
                          @endif

                          @if (session()->has('messagealert'))
                          <div class="alert alert-danger" role="alert">
                          {{ session()->get('messagealert') }}
                          </div>
                          @endif
    <section class="content">
        @yield('content')
    </section>
  </div>

<!--  4.  Right Menu-->
@include('layouts.menu.rightmenu')
<!--  5.  Footer Menu-->
@include('layouts.menu.footermenu')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.6.0.js"> </script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('vendors/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- statistique -->
<script src="{{ asset('js/statistiquechart.js') }}"
integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- jQuery -->
<script src="{{ asset('vendors/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('vendors/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('vendors/dist/js/adminlte.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('vendors/plugins/chart.js/Chart.min.js') }}"></script>


<!-- Select2 -->
<script src="{{ asset('vendors/plugins/select2/js/select2.full.min.js') }}"></script>

<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('vendors/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

<!-- Debut de retour a la ligne-->
<script>
    const splitString = (text, chunkSize) => {
        const arr = text.split(" ")
        const output = []

        for (let i = 0, length = arr.length; i < length; i += chunkSize) {
            output.push(arr.slice(i, i + chunkSize))
        }

        return output
    };
</script>
<!-- Fin de retour a la ligne-->

<script type="text/javascript">
const currentLocation = location.href;
const menuItem = document.querySelectorAll('a')
const menuLength = menuItem.length
for (let i = 0; i<menuLength; i++){
  if(menuItem[i].href === currentLocation){
    menuItem[i].className = "nav-link active"
  }
} /**"copy", "csv" , "colvis" */
</script>

<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2();
    });
</script>
<script>
    $(function () {
//Initialize Select2 Elements
$('.select2bs4').select2({
  theme: 'bootstrap4'})
  });
</script>

<style type="text/css" media="print"> @page { size: landscape; } </style>

<!-- Debut activites -->



@foreach ($collections as $collection)
  @foreach($collection['groupe_activites'] as $groupe_activite)
    @foreach($groupe_activite['activites'] as $activite)
    <script type="text/javascript">
        let labels{{$activite['activite_id']}} = [
                        @foreach ($activite['taches'] as $tache)
                            splitString(('{{ $tache->libelletache }} "{{round($tache->valeurpost,0) }}"'),3),
                        @endforeach
                    ];
        let myChart{{$activite['activite_id']}} = document.getElementById("activite{{$activite['activite_id']}}").getContext('2d');

        let activite{{$activite['activite_id']}} = new Chart(myChart{{$activite['activite_id']}}, {
            type: 'radar',
            data: {
                labels: labels{{$activite['activite_id']}},
                datasets: [
                {
                    label: 'Radar',
                    fillColor: "rgba(25, 25, 25, 5)",
                    backgroundColor: "rgba(0, 0, 55, 0.3)", //"rgb(55, 144, 246)"
                    borderColor: "rgba(54, 162, 235, 1)",
                    pointBorderColor: "#191919",
                    pointBackgroundColor: "rgba(25, 25, 25, 5)",
                    data: [
                            @foreach ($activite['taches'] as $tache)
                                '{{ $tache->valeurpost }}',
                            @endforeach
                    ]
                }
                ]
            },
            options: {
            responsive: true,
                legend: {
                position: 'top',
                    labels: {
                        fontSize:0,
                        fontColor: "rgb(55, 144, 246)",
                    }
                },
                scale: {
                ticks: {
                    fontSize: 10,
                    fontColor: 'red',
                    max: 4,
                    min: 0,
                    stepSize: 1,
                },
                angleLines: {
                    color: 'red',
                },
                gridLines: {
                    color: 'black',
                },
                pointLabels: {
                    fontSize: 13,
                    fontColor: 'black',
                }
            },
            }
        });
        </script>
      @endforeach
    @endforeach
@endforeach

</body>
</html>
