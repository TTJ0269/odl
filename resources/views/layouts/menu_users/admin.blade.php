@can('admin','App\Models\User')
     <li class="nav-item">
        <a href="{{ route('profils.index') }}" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Profils
        </p>
        </a>
    </li>

    <!--li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
            User
        </p>
        </a>
    </li-->

    <li class="nav-item">
        <a href="{{ route('autre_user') }}" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Utilisateurs
        </p>
        </a>
    </li>

    <!--li class="nav-item">
        <a href="{{ route('appartenances.index') }}" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Tuteur/Tutrice
        </p>
        </a>
    </li-->

    <li class="nav-item">
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
        <a href="{{ route('niveaux.index') }}" class="nav-link">
         <i class="nav-icon fas fa-sort-amount-up-alt"></i>
        <p>
            Niveaux
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
        <a href="{{ route('filieres.index') }}" class="nav-link">
        <i class="nav-icon fab fa-foursquare"></i>
        <p>
            Filières
        </p>
        </a>
    </li>


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
        <a href="{{ route('associations.index') }}" class="nav-link">
        <i class="nav-icon fas fa-clone"></i>
        <p>
            Associations
        </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('rattachers.index') }}" class="nav-link">
        <i class="nav-icon fas fa-expand"></i>
        <p>
            Rattachements
        </p>
        </a>
    </li>

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
        <a href="{{ route('positionnements.index') }}" class="nav-link">
        <i class="nav-icon fas fa-signal"></i>
        <p>
            Apprenants
        </p>
        </a>
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
        <a href="{{ route('import_index') }}" class="nav-link">
        <i class="nav-icon fas fa-file-download"></i>
        <p>
            Importation
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

    <li class="nav-item">
        <a href="{{ route('historique_index') }}" class="nav-link">
        <i class="nav-icon fas fa-folder-open"></i>
        <p>
            Historiques
        </p>
        </a>
    </li>

@endcan
