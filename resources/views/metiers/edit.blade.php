@extends('layouts.app')

@section('content')

<h4>Modifier le métier: {{ $metier->libellemetier }}</h4>
<form action="{{ route('metiers.update', ['metier' => $metier->id]) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
  @include('metiers.form')
    <button type="submit" class="btn btn-primary my-3">Sauvegarder</button>
</form>

@endsection
