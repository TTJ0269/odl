  <!-- cadre general -->
<div class="card card-secondary direct-chat direct-chat-secondary">
    <div class="card-header">
    <h2 class="card-title">Fiche de positionnement</h2>
        <div class="card-tools">
            <span data-toggle="tooltip" title="user" class="nav-icon fas fa-book-open"></span>
        </div>
    </div>

    <!-- /.content-header -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 my-2">
                    <table id="exa" class="table table-bordered table-striped">
                        <thead>
                            <th scope="col">Numero</th>
                            <th scope="col">Compétence</th>
                        </thead>

                        <input type="number" hidden value="{{$classe_id}}" name="classe_id"/>

                            <tbody>
                            @foreach($collections as $key=>$collection)
                            <tr>
                            <th scope="row" style="color:rgb(55, 144, 246);"> {{++$key}} </th>
                            <th scope="row" style="color:rgb(55, 144, 246);"> {{$collection[1]}} </th>
                            <tr>
                            <th>
                            <th scope="row">

                                <table id="ea" class="table table-bordered table-striped">
                                <thead>
                                <th scope="col">Activité</th>
                                <th scope="col">Positionnment_activité</th>
                                </thead>
                                <tbody>
                                    @foreach($collection[2] as $activite)
                                    <tr>
                                    <th scope="row"> {{$activite->libelleactivite}} </th>
                                    <th scope="row">
                                    <div class="form-group clearfix">
                                        <div class="icheck-danger d-inline">
                                        <input type="radio" id="radioDanger{{$activite->id}}" value="0" name="valeurpost_{{$activite->id}}" checked>
                                        <label for="radioDanger{{$activite->id}}"></label>
                                        </div>
                                        <div class="icheck-orange d-inline">
                                        <input type="radio" id="radioOrange{{$activite->id}}" value="1" name="valeurpost_{{$activite->id}}">
                                        <label for="radioOrange{{$activite->id}}"></label>
                                        </div>
                                        <div class="icheck-purple d-inline">
                                        <input type="radio" id="radioPurple{{$activite->id}}" value="2" name="valeurpost_{{$activite->id}}">
                                        <label for="radioPurple{{$activite->id}}"></label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary{{$activite->id}}" value="3" name="valeurpost_{{$activite->id}}">
                                        <label for="radioPrimary{{$activite->id}}"></label>
                                        </div>
                                        <div class="icheck-success d-inline">
                                        <input type="radio" id="radioSuccess{{$activite->id}}" value="4" name="valeurpost_{{$activite->id}}">
                                        <label for="radioSuccess{{$activite->id}}"></label>
                                        </div>
                                    </div>
                                    </th>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                                </th>
                            </th>
                            </tr>
                            </tr>
                            @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
