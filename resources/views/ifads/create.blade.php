@extends('layouts.app')

@section('content')

<div class="content">

            <form action="{{ route('ifads.store') }}" method="POST" enctype="multipart/form-data">
            @include('ifads.form')
                <button type="submit" class="btn btn-primary my-3">Ajouter un IFAD</button>
            </form>     
</div>

@endsection