@extends('layouts.app')

@section('content')

@foreach ($activites as $activite)
<form action="{{ route('positionnements.update', ['positionnement' => $activite->id]) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
  @include('positionnements.formmodif')
      <div class="text-center">
         <button type="submit" class="btn btn-primary my-3">Sauvegarder</button>
      </div>
</form>
@endforeach

@endsection