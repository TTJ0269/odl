@extends('layouts.app')

@section('content')

<h4>Modifier le profil: {{ $profil->libelleprofil }}</h4>
<form action="{{ route('profils.update', ['profil' => $profil->id]) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
  @include('profils.form')
    <button type="submit" class="btn btn-primary my-3">Sauvegarder</button>
</form>

@endsection
