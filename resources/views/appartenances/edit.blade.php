@extends('layouts.app')

@section('content')

<form action="{{ route('appartenances.update', ['appartenance' => $appartenance->id]) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
  @include('appartenances.formmodif')
    <button type="submit" class="btn btn-primary my-3">Sauvegarder les informations</button>
</form>

@endsection
