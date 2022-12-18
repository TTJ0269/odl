@extends('layouts.app')

@section('content')

<div class="content">

            <form action="{{ route('niveaux.store') }}" method="POST" enctype="multipart/form-data">
            @include('niveaux.form')
                <button type="submit" class="btn btn-primary my-3">Valider</button>
            </form>
</div>

@endsection
