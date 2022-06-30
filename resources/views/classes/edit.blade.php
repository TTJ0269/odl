@extends('layouts.app')

@section('content')

<h4>Modifier la classe: {{ $class->libelleclasse }}</h4>
<form action="{{ route('classes.update', ['class' => $class->id]) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
  @include('classes.form')
    <button type="submit" class="btn btn-primary my-3">Sauvegarder</button>
</form>

@endsection
