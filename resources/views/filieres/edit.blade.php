@extends('layouts.app')

@section('content')

<h4>Modifier le filiére: {{ $filiere->libellefiliere }}</h4>
<form action="{{ route('filieres.update', ['filiere' => $filiere->id]) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
  @include('filieres.form')
    <button type="submit" class="btn btn-primary my-3">Sauvegarder</button>
</form>

@endsection
