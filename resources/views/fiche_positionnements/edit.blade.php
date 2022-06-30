@extends('layouts.app')

@section('content')

<form action="{{ route('fiche_positionnements.update', ['fiche_positionnement' => $fiche_positionnement->id]) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
  @include('fiche_positionnements.formmodif')
    <button type="submit" class="btn btn-primary my-3">Sauvegarder</button>
</form>

@endsection
