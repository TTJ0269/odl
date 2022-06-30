  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand @if(Auth::user()->preference->last()) {{Auth::user()->preference->last()->top}} @else navbar-white @endif navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('dashboard') }}" class="nav-link">Accueil</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-address-card"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">Status</span>
          <div class="dropdown-divider"></div>
          <a href="{{ route('profilusershow') }}" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> Profil
                   <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
                      <!-- Authentication -->
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <x-responsive-nav-link :href="route('logout')"
                                  onclick="event.preventDefault();
                                              this.closest('form').submit();">
                     <i class="fas fa-user mr-2"></i>{{ __('Deconnexion') }}
                          </x-responsive-nav-link>
                      </form>
            </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>

     </ul>
</nav>
  <!-- /.navbar -->
