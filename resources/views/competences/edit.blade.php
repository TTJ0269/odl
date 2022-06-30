@extends('layouts.app')

@section('content')

<h4>Modification</h4>
<form action="{{ route('competences.update', ['competence' => $competence->id]) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
  @include('competences.form')
    <button type="submit" class="btn btn-primary my-3">Sauvegarder les informations</button>
</form>

@endsection
