@extends('layouts.app')

@section('content')

<div class="content">

            <form action="{{ route('filieres.store') }}" method="POST" enctype="multipart/form-data">
            @include('filieres.form')
                <button type="submit" class="btn btn-primary my-3">Ajouter</button>
            </form>
</div>

@endsection
