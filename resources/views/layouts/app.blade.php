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
<body class="hold-transition @if(Auth::user()->preference->last()) {{Auth::user()->preference->last()->center}} @else '' @endif sidebar-mini layout-fixed">
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

<!-- DataTables  & Plugins -->
<script src="{{ asset('vendors/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('vendors/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('vendors/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- Select2 -->
<!--script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script-->

<script src="{{ asset('vendors/plugins/select2/js/select2.full.min.js') }}"></script>

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
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
    /*$(".multiple-select").select2({
     // maximumSelectionLength: 2
     });*/
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2({
        multiple:true,
        tags:true
      });
    });
</script>
<script>
    $(function () {
//Initialize Select2 Elements
$('.select2bs4').select2({
  theme: 'bootstrap4'})
  });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#ifad').on('change', function () {
            var ifadId = this.value;
            $('#user').html('');
            $.ajax({
                url: '{{ route('get_index') }}?ifad_id='+ifadId,
                type: 'get',
                success: function (res) {
                    $('#user').html('<option value="">Sélectionner un(e) apprenant(e)</option>');
                    $.each(res, function (key, value) {
                        $('#user').append('<option value="' + value
                            .id + '">' +''+ value.nomuser + ' ' + value.prenomuser +'</option>');
                    });
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#ifad').on('change', function () {
            var ifadId = this.value;
            $('#classe').html('');
            $.ajax({
                url: '{{ route('get_ifad') }}?ifad_id='+ifadId,
                type: 'get',
                success: function (res) {
                    $('#classe').html('<option value="">Sélectionner une classe</option>');
                    $.each(res, function (key, value) {
                        $('#classe').append('<option value="' + value
                            .id + '">' +''+ value.libelleclasse +'</option>');
                    });
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#metier').on('change', function () {
            var metierId = this.value;
            $('#classe').html('');
            $.ajax({
                url: '{{ route('get_classe') }}?metier_id='+metierId,
                type: 'get',
                success: function (res) {
                    $('#classe').html('<option value="">Sélectionner une classe</option>');
                    $.each(res, function (key, value) {
                        $('#classe').append('<option value="' + value
                            .id + '">' +''+ value.libelleclasse +'</option>');
                    });
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#user').on('change', function () {
            var userId = this.value;
            $('#fichepositionnement').html('');
            $.ajax({
                url: '{{ route('getfichepositionnement') }}?user_id='+userId,
                type: 'get',
                success: function (res) {
                    $('#fichepositionnement').html(['<option value="">Sélectionner une fiche de positionnement</option>']);
                    $.each(res, function (key, value) {
                        $('#fichepositionnement').append('<option value="' + value
                            .id + '">' +''+ value.libellefiche +'</option>');
                    });
                }
            });
        });
    });
</script>

</body>
</html>
