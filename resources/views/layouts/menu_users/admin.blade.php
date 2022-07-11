@can('admin','App\Models\User')
     <li class="nav-item">
        <a href="{{ route('profils.index') }}" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Profil
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Utilisateur
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
        <a href="{{ route('entreprises.index') }}" class="nav-link">
        <i class="nav-icon fas fa-building"></i>
        <p>
            Entreprise
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
        <i class="nav-icon fas fa-chalkboard-teacher"></i>
        <p>
            Classe
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('associations.index') }}" class="nav-link">
        <i class="nav-icon fas fa-clone"></i>
        <p>
            Association
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('suivis.index') }}" class="nav-link">
        <i class="nav-icon fas fa-crop-alt"></i>
        <p>
            Stage
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('fiche_positionnements.index') }}" class="nav-link">
        <i class="nav-icon fas fa-book-open"></i>
        <p>
            Fiche Positionnement
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('positionnements.index') }}" class="nav-link">
        <i class="nav-icon fas fa-signal"></i>
        <p>
            Stagiaire
        </p>
        </a>
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

    <li class="nav-item">
        <a href="{{ route('historique_index') }}" class="nav-link">
        <i class="nav-icon fas fa-folder-open"></i>
        <p>
            Historique
        </p>
        </a>
    </li>

@endcan
