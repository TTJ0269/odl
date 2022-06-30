@extends('layouts.app')

@section('content')

<h4>Modifier l'activité: {{ $activite->libelleactivite }}</h4>
<form action="{{ route('activites.update', ['activite' => $activite->id]) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
  @include('activites.form')
    <button type="submit" class="btn btn-primary my-3">Sauvegarder les informations</button>
</form>

@endsection
