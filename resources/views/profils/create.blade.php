@extends('layouts.app')

@section('content')

<div class="content">

            <form action="{{ route('profils.store') }}" method="POST" enctype="multipart/form-data">
            @include('profils.form')
                <button type="submit" class="btn btn-primary my-3">Ajouter un profil</button>
            </form>
</div>

@endsection
