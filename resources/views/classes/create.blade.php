@extends('layouts.app')

@section('content')

<div class="content">

            <form action="{{ route('classes.store') }}" method="POST" enctype="multipart/form-data">
            @include('classes.form')
                <button type="submit" class="btn btn-primary my-3">Ajouter une classe</button>
            </form>
</div>

@endsection
