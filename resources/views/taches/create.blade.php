@extends('layouts.app')

@section('content')

<div class="content">

            <form action="{{ route('taches.store') }}" method="POST" enctype="multipart/form-data">
            @include('taches.form')
                <button type="submit" class="btn btn-primary my-3">Ajouter une tâche</button>
            </form>
</div>

@endsection
