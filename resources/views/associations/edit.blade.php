@extends('layouts.app')

@section('content')

<form action="{{ route('associations.update', ['association' => $association->id]) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
  @include('associations.form')
    <button type="submit" class="btn btn-primary my-3">Sauvegarder les informations</button>
</form>

@endsection
