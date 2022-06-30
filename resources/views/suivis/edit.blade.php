@extends('layouts.app')

@section('content')

<h4>Modification</h4>
<form action="{{ route('suivis.update', ['suivi' => $suivi->id]) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
  @include('suivis.form')
    <button type="submit" class="btn btn-primary my-3">Sauvegarder</button>
</form>

@endsection
