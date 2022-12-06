@can('admin','App\Models\User')
    <div> <i class="fas fa-poll bg-primary"></i>
        <div class="timeline-item">
        <!--span class="time"><i class="far fa-clock"></i> 12:05</span-->
        <h3 class="timeline-header" style="color: rgb(39, 71, 166)"> <a href="{{route('positionnements.index')}}"> Positionner un apprenant </a></h3>
            <div class="timeline-body">
            <h6> &#128413; Aller dans le menu "Apprenant" </h6>
            <h6> &#128413; Séléctionner le métier ainsi que la classe de l'apprenant(e) et valider </h6>
            <h6> &#128413; Choisir l'apprenant(e) dans la liste affichée </h6>
            <h6> &#128413; Positionner l'apprenant(e) selon les différentes activités </h6>
            </div>
        </div>
    </div>


    <div> <i class="fas fa-book-open bg-success"></i>
    <div class="timeline-item">
        <!--span class="time"><i class="far fa-clock"></i> 12:05</span-->
        <h3 class="timeline-header" style="color: rgb(39, 71, 166)"><a href="{{route('fiche_positionnements.index')}}">Consulter la fiche de positionnement </a></h3>
            <div class="timeline-body">
            <h6> &#128413; Aller dans le menu "Fiche de positionnement" </h6>
            <h6> &#128413; Rechercher l'apprenant(e) et choisissez sa fiche </h6>
            </div>
        </div>
    </div>

    <div> <i class="fas fa-comments bg-warning"></i>
    <div class="timeline-item">
        <!--span class="time"><i class="far fa-clock"></i> 12:05</span-->
        <h3 class="timeline-header" style="color: rgb(39, 71, 166)"> <a href="{{route('positionnements.index')}}"> Faire des observations </a></h3>
            <div class="timeline-body">
            <h6> &#128413; Aller dans le menu "Apprenant" </h6>
            <h6> &#128413; Séléctionner le métier ainsi que la classe de l'apprenant(e) et valider </h6>
            <h6> &#128413; Rechercher l'apprenant(e) et cliquer sur l'icone de l'observation </h6>
            </div>
        </div>
    </div>
@endcan
