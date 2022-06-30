@extends('layouts.app')

@section('content')

<div class="content">

            <form action="{{ route('competences.store') }}" method="POST" enctype="multipart/form-data">
            @include('competences.form')
                <button type="submit" class="btn btn-primary my-3"> Valider </button>
            </form>
</div>

@endsection
