@can('dg_ifad','App\Models\User')
    <li class="nav-item">
        <a href="{{ route('fiche_positionnements.index') }}" class="nav-link">
        <i class="nav-icon fas fa-book-open"></i>
        <p>
            Fiche Positionnement
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
@endcan
