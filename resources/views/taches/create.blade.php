@extends('layouts.app')

@section('content')

<div class="content">

            <form action="{{ route('taches.store') }}" method="POST" enctype="multipart/form-data">
            @include('taches.form')
                <button type="submit" class="btn btn-primary my-3">Ajouter une tâche</button>
            </form>
</div>

<h6> <u style="color:rgb(209, 16, 16);">NB:</u> Apostrophe n'est pas autorisé pour le renseignement de la tâche en raison de d'affichage de la statistique. </h6>

@endsection
