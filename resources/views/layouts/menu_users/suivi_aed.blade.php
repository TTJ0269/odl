@can('suivi_aed','App\Models\User')
    <!--li class="nav-item">
        <a href="{{ route('entreprises.index') }}" class="nav-link">
        <i class="nav-icon fas fa-building"></i>
        <p>
            Entreprises
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('ifads.index') }}" class="nav-link">
        <i class="nav-icon fas fa-school"></i>
        <p>
            IFAD
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('classes.index') }}" class="nav-link">
        <i class="nav-icon fas fa-door-open"></i>
        <p>
            Classes
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('metiers.index') }}" class="nav-link">
        <i class="nav-icon fas fa-chalkboard-teacher"></i>
        <p>
            Métiers
        </p>
        </a>
    </li-->

    <li class="nav-item">
        <a href="{{ route('groupe_activites.index') }}" class="nav-link">
        <i class="nav-icon fas fa-bookmark"></i>
        <p>
            Fonctions <!-- Fonction = Groupe d'activite-->
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('activites.index') }}" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
            Activités
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('taches.index') }}" class="nav-link">
        <i class="nav-icon fas fa-paste"></i>
        <p>
            Tâches
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-book-open"></i>
        <p>
            Fiche Positionnements
            <i class="right fas fa-angle-left"></i>
        </p>
        </a>
        <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{ route('fiche_positionnements.index') }}" class="nav-link">
            <i class="nav-icon fas fa-folder-open"></i>
            <p>Non archivées</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('fiches_archive_show') }}" class="nav-link">
            <i class="nav-icon fas fa-folder"></i>
            <p>Archivées</p>
            </a>
        </li>

        </ul>
    </li>

    <li class="nav-item">
        <a href="{{ route('observations.index') }}" class="nav-link">
        <i class="nav-icon fas fa-comments"></i>
        <p>
            Observations
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>
            Information du suivi
            <i class="right fas fa-angle-left"></i>
        </p>
        </a>
        <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{ route('statistique_index') }}" class="nav-link">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>Radars de positionnement</p>
            </a>
        </li>

        </ul>
    </li>
@endcan
