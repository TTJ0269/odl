<!DOCTYPE html>
<html lang="en">
<head>
<!-- basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- mobile metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<!-- site metas -->
<title>Acceuil</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">
<!-- bootstrap css -->
<link rel="stylesheet" type="text/css" href="{{ asset('bb/css/bootstrap.min.css') }}">
<!-- style css -->
<link rel="stylesheet" type="text/css" href="{{ asset('bb/css/style.css') }}">
<!-- Responsive-->
<link rel="stylesheet" href="{{ asset('bb/css/responsive.css') }}">
<!-- fevicon -->
<link rel="icon" href="{{ asset('bb/images/fevicon.png') }}" type="image/gif" />
<!-- Scrollbar Custom CSS -->
<link rel="stylesheet" href="{{ asset('bb/css/jquery.mCustomScrollbar.min.css') }}">
<!-- Tweaks for older IEs-->
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<!-- owl stylesheets -->
<link rel="stylesheet" href="{{ asset('bb/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('bb/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>
<body>

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
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
            @yield('content')
        </section>
      </div>


    <div class="contact_section layout_padding">
        <div class="container-fluid">
            <div style="text-align: center;margin-top:50px"><p style="font-size: 100%">&#169; Copyright Agence Education Développement</p></div>
        </div>
    </div>

    <!--div class="copyright_section">
      <div class="container">
        <p class="copyright_text">Outil de liaison <a href="# "></a></p>
      </div>
    </div-->
    <!-- copyright section end -->
    <!-- Javascript files-->
    <script src="{{ asset('bb/js/jquery.min.js') }}"></script>
    <script src="{{ asset('bb/js/popper.min.js') }}"></script>
    <script src="{{ asset('bb/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bb/js/jquery-3.0.0.min.js') }}"></script>
    <script src="{{ asset('bb/js/plugin.js') }}"></script>
    <!-- sidebar -->
    <script src="{{ asset('bb/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('bb/js/custom.js') }}"></script>
    <!-- javascript -->
    <script src="{{ asset('bb/js/owl.carousel.js') }}"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
</body>
</html>
