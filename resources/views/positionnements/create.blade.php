@extends('layouts.app')

@section('content')

<div class="content">

            <form action="{{ route('positionnements.store') }}" method="POST" enctype="multipart/form-data">
            @include('positionnements.form')
              <div class="text-center">
                <button type="submit" class="btn btn-primary my-5"> Valider </button>
              </div>
            </form>
</div>

@endsection
