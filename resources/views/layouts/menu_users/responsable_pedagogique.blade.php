@can('responsable_pedagogique','App\Models\User')
    <li class="nav-item">
        <a href="{{ route('ifads.index') }}" class="nav-link">
        <i class="nav-icon fas fa-school"></i>
        <p>
            IFAD
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('apprenants.index') }}" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Apprenant
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('appartenances.index') }}" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Tuteur/Tutrice
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('entreprises.index') }}" class="nav-link">
        <i class="nav-icon fas fa-building"></i>
        <p>
            Entreprise
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('metiers.index') }}" class="nav-link">
        <i class="nav-icon fas fa-chalkboard-teacher"></i>
        <p>
            Métier
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('groupe_activites.index') }}" class="nav-link">
        <i class="nav-icon fas fa-bookmark"></i>
        <p>
            Groupe Activité
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('activites.index') }}" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
            Activité
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('taches.index') }}" class="nav-link">
        <i class="nav-icon fas fa-paste"></i>
        <p>
            Tâche
        </p>
        </a>
    </li>

    <!--li class="nav-item">
        <a href="{{ route('associations.index') }}" class="nav-link">
        <i class="nav-icon fas fa-clone"></i>
        <p>
            Association
        </p>
        </a>
    </li-->

    <li class="nav-item">
        <a href="{{ route('suivis.index') }}" class="nav-link">
        <i class="nav-icon fas fa-crop-alt"></i>
        <p>
            PFMP
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-book-open"></i>
        <p>
            Fiche Positionnement
            <i class="right fas fa-angle-left"></i>
        </p>
        </a>
        <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{ route('fiche_positionnements.index') }}" class="nav-link">
            <i class="nav-icon fas fa-folder-open"></i>
            <p>Non archivé</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('fiches_archive_show') }}" class="nav-link">
            <i class="nav-icon fas fa-folder"></i>
            <p>Archivé</p>
            </a>
        </li>

        </ul>
    </li>

    <li class="nav-item">
        <a href="{{ route('observations.index') }}" class="nav-link">
        <i class="nav-icon fas fa-comments"></i>
        <p>
            Observation
        </p>
        </a>
    </li>

    <!--li class="nav-item">
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
            <p>Statistique</p>
            </a>
        </li>

        </ul>
    </li-->
@endcan
