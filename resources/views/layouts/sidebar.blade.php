<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <li><a href="/dashboard"><i class="fas fa-laptop"></i> Dashboard </a></li>
            <li>
                <a><i class="fas fa-th-large"></i> Book <span
                        class="fas fa-chevron-down arrow-icon"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('books.index') }}">View</a></li>
                    <li><a href="{{ route('books.create') }}">Create</a></li>
                </ul>
            </li>
            <li>
                <a><i class="fas fa-th-large"></i> Type <span
                        class="fas fa-chevron-down arrow-icon"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('types.index') }}">View</a></li>
                    <li><a href="{{ route('types.create') }}">Create</a></li>
                </ul>
            </li>
        </ul>

    </div>
</div>
