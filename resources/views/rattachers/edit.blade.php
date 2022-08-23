@extends('layouts.app')

@section('content')

<form action="{{ route('rattachers.update', ['rattacher' => $rattacher->id]) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
  @include('rattachers.form')
    <button type="submit" class="btn btn-primary my-3">Sauvegarder les informations</button>
</form>

@endsection
