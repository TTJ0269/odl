@extends('layouts.app')

@section('content')

<div class="content">

            <form action="{{ route('associations.store') }}" method="POST" enctype="multipart/form-data">
            @include('associations.form')
                <button type="submit" class="btn btn-primary my-3">Ajouter</button>
            </form>
</div>

@endsection
