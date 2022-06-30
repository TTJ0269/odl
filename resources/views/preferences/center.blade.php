<form action="{{ route('preference_center') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="number" hidden  name="preference_id" value="">
    <div class="form-group row">
        <label for="text" class="col-sm-4 col-form-label">Centre</label>
        <div class="col-sm-6">
            <select class="form-control @error('preference_center') is-invalid @enderror" name="preference_center" id="preference_center">
                <option value="" selected disabled> -Choisir- </option>
                <option value=""> Clair </option>
                <option value="dark-mode">Sombre</option>
            </select>
            @error('preference_center')
            <div class="invalid-feedback">
                {{ $errors->first('preference_center')}}
            </div>
            @enderror
        </div>
        <div class="col-sm-2">
            <button type="submit" class="btn btn-primary"> <i class="fas fa-check"></i></button>
        </div>
    </div>
</form>
