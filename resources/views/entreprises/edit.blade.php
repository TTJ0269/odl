@extends('layouts.app')

@section('content')

<h4>Modifier l'entreprise: {{ $entreprise->libelleentreprise }}</h4>
<form action="{{ route('entreprises.update', ['entreprise' => $entreprise->id]) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
  @include('entreprises.form')
    <button type="submit" class="btn btn-primary my-3">Sauvegarder</button>
</form>

@endsection
