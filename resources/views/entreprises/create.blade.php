@extends('layouts.app')

@section('content')

<div class="content">

            <form action="{{ route('entreprises.store') }}" method="POST" enctype="multipart/form-data">
            @include('entreprises.form')
                <button type="submit" class="btn btn-primary my-3">Ajouter une entreprise</button>
            </form>
</div>

@endsection
