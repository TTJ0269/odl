@extends('layouts.app')

@section('content')

<h4>Modifier le groupe d'activité: {{ $groupe_activite->libellegroupe }}</h4>
<form action="{{ route('groupe_activites.update', ['groupe_activite' => $groupe_activite->id]) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
  @include('groupe_activites.form')
    <button type="submit" class="btn btn-primary my-3">Sauvegarder</button>
</form>

@endsection
