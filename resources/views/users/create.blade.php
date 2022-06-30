@extends('layouts.app')

@section('content')

<div class="content">

            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @include('users.form')
              <button type="submit" class="btn btn-primary my-3">Ajouter un utilisateur</button>
            </form>
</div>

@endsection
