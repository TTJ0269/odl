@can('suivi_aed','App\Models\User')
<div> <i class="fas fa-book-open bg-success"></i>
    <div class="timeline-item">
   <!--span class="time"><i class="far fa-clock"></i> 12:05</span-->
   <h3 class="timeline-header" style="color: rgb(39, 71, 166)"><a href="{{route('fiche_positionnements.index')}}">Consulter la fiche de positionnement </a></h3>
       <div class="timeline-body">
       <h6> &#128413; Aller dans le menu Fiche de positionnement </h6>
       <h6> &#128413; Rechercher l'apprenant(e) et choisissez sa fiche </h6>
       </div>
   </div>
</div>

<div> <i class="fas fa-comments bg-warning"></i>
   <div class="timeline-item">
   <!--span class="time"><i class="far fa-clock"></i> 12:05</span-->
   <h3 class="timeline-header" style="color: rgb(39, 71, 166)"> <a href="{{route('observations.index')}}"> Voir les observations </a></h3>
       <div class="timeline-body">
       <h6> &#128413; Aller dans le menu Observation </h6>
       <h6> &#128413; Rechercher l'apprenant(e) et visualiser </h6>
       </div>
   </div>
</div>

<div> <i class="fas fa-chart-line bg-success"></i>
    <div class="timeline-item">
    <!--span class="time"><i class="far fa-clock"></i> 12:05</span-->
    <h3 class="timeline-header" style="color: rgb(39, 71, 166)"> <a href="{{route('observations.index')}}"> Accéder aux radars de positionnements </a></h3>
        <div class="timeline-body">
        <h6> &#128413; Aller dans le menu Information du suivi </h6>
        <h6> &#128413; Rechercher l'apprenant(e) et visualiser </h6>
        </div>
    </div>
 </div>
@endcan
