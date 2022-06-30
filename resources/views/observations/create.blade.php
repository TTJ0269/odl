@extends('layouts.app')

@section('content')
<div class="content">

            <form action="{{ route('observations.store') }}" method="POST" enctype="multipart/form-data">
            @include('observations.form')

            <div class="text-center">
                <button type="submit"  class="btn btn-success">
                  <i class="fas fa-comments"></i><span>Ajouter une observation</span>
                </button>
            </div>
            </form>
            
            <hr>
</div>
@endsection
