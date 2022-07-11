@extends('layouts.app')

@section('content')

<h4>Modifier la tâche: {{ $tach->libelletache }}</h4>
<form action="{{ route('taches.update', ['tach' => $tach->id]) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
  @include('taches.form')
    <button type="submit" class="btn btn-primary my-3">Sauvegarder les informations</button>
</form>

@endsection
