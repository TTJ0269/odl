<form action="{{ route('preference_left') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="number" hidden  name="preference_id" value="">
    <div class="form-group row">
        <label for="text" class="col-sm-4 col-form-label">Menu</label>
        <div class="col-sm-6">
            <select class="form-control @error('preference_left') is-invalid @enderror" name="preference_left" id="preference_left">
                <option value="" selected disabled> -Choisir- </option>
                <option value=""> Clair </option>
                <option value="sidebar-dark-primary">Sombre</option>
            </select>
            @error('preference_left')
            <div class="invalid-feedback">
                {{ $errors->first('preference_left')}}
            </div>
            @enderror
        </div>
        <div class="col-sm-2">
            <button type="submit" class="btn btn-primary"> <i class="fas fa-check"></i></button>
        </div>
    </div>
</form>
