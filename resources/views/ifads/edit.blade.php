@extends('layouts.app')

@section('content')

<h4>Modification de : {{ $ifad->libelleifad }}</h4>
<form action="{{ route('ifads.update', ['ifad' => $ifad->id]) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
  @include('ifads.form')
    <button type="submit" class="btn btn-primary my-3">Sauvegarder</button>
</form>

@endsection
