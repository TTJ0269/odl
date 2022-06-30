<form action="{{ route('preference_top') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="number" hidden  name="preference_id" value="">
    <div class="form-group row">
        <label for="text" class="col-sm-4 col-form-label">Haut</label>
        <div class="col-sm-6">
            <select class="form-control @error('preference_top') is-invalid @enderror" name="preference_top" id="preference_top">
            <option value="" selected disabled> -Choisir- </option>
            <option value="navbar-white"> Clair </option>
            <option value="navbar-warning">Jaune</option>
            <option value="navbar-success">Vert</option>
            <option value="navbar-danger">Rouge</option>
            <option value="navbar-purple">Violet</option>
            <option value="navbar-dark">Sombre</option>
            </select>
            @error('preference_top')
            <div class="invalid-feedback">
                {{ $errors->first('preference_top')}}
            </div>
            @enderror
        </div>
        <div class="col-sm-2">
            <button type="submit" class="btn btn-primary"> <i class="fas fa-check"></i></button>
        </div>
    </div>
</form>
