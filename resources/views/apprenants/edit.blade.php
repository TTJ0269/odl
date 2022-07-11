@extends('layouts.app')

@section('content')

<h4>Modifier le profil: {{ $apprenant->nomuser }}</h4>
<form action="{{ route('apprenants.update', ['apprenant' => $apprenant->id]) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
  @include('apprenants.form')
    <button type="submit" class="btn btn-primary my-3">Sauvegarder les informations</button>
</form>

@endsection
