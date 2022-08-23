@extends('layouts.app')

@section('content')

<h4>Modification de : {{ $formateur->nomuser }} {{ $formateur->prenomuser }}</h4>
<form action="{{ route('formateurs.update', ['formateur' => $formateur->id]) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
  @include('formateurs.formmodif')
    <button type="submit" class="btn btn-primary my-3">Sauvegarder</button>
</form>

@endsection
