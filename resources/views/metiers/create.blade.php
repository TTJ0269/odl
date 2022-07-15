@extends('layouts.app')

@section('content')

<div class="content">

            <form action="{{ route('metiers.store') }}" method="POST" enctype="multipart/form-data">
            @include('metiers.form')
                <button type="submit" class="btn btn-primary my-3">Ajouter un métier</button>
            </form>
</div>

@endsection
