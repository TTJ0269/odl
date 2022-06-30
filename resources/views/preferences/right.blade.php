<form action="{{ route('preference_right') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="number" hidden  name="preference_id" value="">
    <div class="form-group row">
        <label for="text" class="col-sm-4 col-form-label">Droit</label>
        <div class="col-sm-6">
            <select class="form-control @error('preference_right') is-invalid @enderror" name="preference_right" id="preference_right">
                <option value="" selected disabled> -Choisir- </option>
                <option value=""> Transparent </option>
                <option value="control-sidebar-dark">Sombre</option>
            </select>
            @error('preference_right')
            <div class="invalid-feedback">
                {{ $errors->first('preference_right')}}
            </div>
            @enderror
        </div>
        <div class="col-sm-2">
            <button type="submit" class="btn btn-primary"> <i class="fas fa-check"></i></button>
        </div>
    </div>
</form>
