@extends('layouts.app')

@section('content')

<form action="{{ route('observations.update', ['observation' => $observation->id]) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
  @include('observations.form')
    <button type="submit" class="btn btn-primary my-3">Sauvegarder</button>
</form>

@endsection
