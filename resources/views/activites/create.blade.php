@extends('layouts.app')

@section('content')

<div class="content">

            <form action="{{ route('activites.store') }}" method="POST" enctype="multipart/form-data">
            @include('activites.form')
                <button type="submit" class="btn btn-primary my-3">Ajouter une activité</button>
            </form>     
</div>

@endsection