@extends('layouts.apptemple')

@section('content')

    <!-- banner section start -->
    <div class="banner_section layout_padding">
      <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="text-center">
                    <h1 style="font-size: 300%;text-transform: uppercase; color:rgb(5, 50, 95); font-family: 'bauhaus 93' !important">Outil de Liaison </h1>
                    <div class="col" style="border:1px !important; background-color:#0070ff52; padding-top: 10px">
                       <h4>Cet outil permet de positionner les apprenants dans l’acquisition des compétences à l’IFAD et en entreprise.</h4>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="banner_section_2">
            <div class="row" style="margin-right: 40px; margin-left: 70px">
              <div class="col-lg-4 col-sm-12 my-2">
                    <div class="container_main1">
                        <a href="{{ route('send_logo', ['logo' => 'ifad_batiment.png','name' => 'IFAD-BATIMENT']) }}">
                            <img src="{{ asset('bb/images/ifad_batiment.png') }}" alt="Avatar" class="image" style="width:95%">
                            <div class="middle">
                            <div class="text"><strong>IFAD-BATIMENT</strong></div>
                            </div>
                        </a>
                    </div>
              </div>
              <div class="col-lg-4 col-sm-12  my-2">
                <div class="container_main1">
                    <a href="{{ route('send_logo', ['logo' => 'ifad_aquaculture.png','name' => 'IFAD-AQUACULTURE']) }}">
                        <img src="{{ asset('bb/images/ifad_aquaculture.png') }}" alt="Avatar" class="image" style="width:95%">
                        <div class="middle">
                        <div class="text"><strong>IFAD-AQUACULTURE</strong></div>
                        </div>
                    </a>
                </div>
              </div>
              <div class="col-lg-4 col-sm-12  my-2">
                <div class="container_main1">
                    <a href="{{ route('send_logo', ['logo' => 'ifad_elevage.png','name' => 'IFAD-ELEVAGE']) }}">
                        <img src="{{ asset('bb/images/ifad_elevage.png') }}" alt="Avatar" class="image" style="width:95%">
                        <div class="middle">
                        <div class="text"><strong>IFAD-ELEVAGE</strong></div>
                        </div>
                    </a>
                </div>
              </div>

            </div>
          </div>

    </div>
    <!-- banner section end -->
    </div>

    <!-- about section start -->

@endsection
