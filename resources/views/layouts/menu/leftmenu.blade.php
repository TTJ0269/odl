  <!-- Main Sidebar Container -->
  <aside class="main-sidebar @if(Auth::user()->preference->last()) {{Auth::user()->preference->last()->left}} @else sidebar-dark-primary @endif elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('vendors/dist/img/aedr.png') }}" alt="AED" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">TOGO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset('storage/image/' .Auth::user()->imageuser) }}" class="img-circle elevation-2" alt="Image">
          </div>
          <div class="info">
           <a href="{{ route('profilusershow')}}" class="d-block"> {{Auth::user()->nomuser}}  {{Auth::user()->prenomuser}}</a>
          </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           @include('layouts.menu_users.admin')
           @include('layouts.menu_users.responsable_pedagogique')
           @include('layouts.menu_users.suivi_aed')
           @include('layouts.menu_users.formateur_ifad')
           @include('layouts.menu_users.charge_suivi')
           @include('layouts.menu_users.dg_ifad')
           @include('layouts.menu_users.apprenant')
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

