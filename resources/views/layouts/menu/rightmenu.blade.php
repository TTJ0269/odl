  <!-- Control Sidebar -->
  <aside class="control-sidebar @if(Auth::user()->preference->last()) {{Auth::user()->preference->last()->right}} @else control-sidebar-dark @endif">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Personnalisation</h5>
      @if(Auth::user()->preference->last())
            @include('preferences.top')
            @include('preferences.left')
            @include('preferences.center')
            @include('preferences.right')
      @else
      <div class="text-center">
        <a href="{{ route('preference_store') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i><span> Avoir une préférence </span></a>
      </div>
      @endif
    </div>
  </aside>
  <!-- /.control-sidebar -->
