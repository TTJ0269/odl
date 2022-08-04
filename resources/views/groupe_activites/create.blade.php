@extends('layouts.app')

@section('content')

<div class="content">

            <form action="{{ route('groupe_activites.store') }}" method="POST" enctype="multipart/form-data">
            @include('groupe_activites.form')
                <button type="submit" class="btn btn-primary my-3">Ajouter</button>
            </form>
</div>

@endsection
