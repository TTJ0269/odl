<form action="{{ route('preference_foot') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">Bas</label>
        <div class="col-sm-10">
            <select class="form-control @error('preference_foot') is-invalid @enderror" name="preference_foot" id="preference_foot">
            <option value=""> Clair </option>
            <option value="dark-mode">Sombre</option>
            </select>
            @error('preference_foot')
            <div class="invalid-feedback">
                {{ $errors->first('preference_foot')}}
            </div>
            @enderror
        </div>
    </div>
    <button type="submit" class="btn btn-primary my-3">Valider</button>
</form>
