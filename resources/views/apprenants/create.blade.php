@extends('layouts.app')

@section('content')

<div class="content">

            <form action="{{ route('apprenants.store') }}" method="POST" enctype="multipart/form-data">
            @include('apprenants.form')
              <button type="submit" class="btn btn-primary my-3">Ajouter un(e) apprenant(e)</button>
            </form>
</div>

@endsection
