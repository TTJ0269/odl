@extends('layouts.app')

@section('content')

<h4>Modifier le niveau: {{ $niveau->libelleniveau }}</h4>
<form action="{{ route('niveaux.update', ['niveau' => $niveau->id]) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
  @include('niveaux.form')
    <button type="submit" class="btn btn-primary my-3">Sauvegarder</button>
</form>

@endsection
