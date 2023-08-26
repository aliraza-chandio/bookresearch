<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <li><a href="/dashboard"><i class="fas fa-laptop"></i> Dashboard </a></li>
            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'editor')
                <li>
                    <a><i class="fas fa-th-large"></i> Master <span
                            class="fas fa-chevron-down arrow-icon"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('masters.index') }}">View</a></li>
                        <li><a href="{{ route('masters.create') }}">Create</a></li>
                    </ul>
                </li>
                {{-- <li>
                    <a><i class="fas fa-list-ul"></i> Master Native <span
                            class="fas fa-chevron-down arrow-icon"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('master_natives.index') }}">View</a></li>
                        <li><a href="{{ route('master_natives.create') }}">Create</a></li>
                    </ul>
                </li> --}}
                <li>
                    <a><i class="fas fa-th-large"></i> Product <span
                            class="fas fa-chevron-down arrow-icon"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('products.index') }}">View</a></li>
                        <li><a href="{{ route('products.create') }}">Create</a></li>
                    </ul>
                </li>
                <li>
                    <a><i class="fas fa-th-large"></i> Scholar Forms <span
                            class="fas fa-chevron-down arrow-icon"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="/scholar-form/view">Form View</a></li>
                    </ul>
                </li>
                {{-- <li>
                    <a><i class="fas fa-list-ul"></i> Product Native <span
                            class="fas fa-chevron-down arrow-icon"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('product_natives.index') }}">View</a></li>
                        <li><a href="{{ route('product_natives.create') }}">Create</a></li>
                    </ul>
                </li> --}}
                @if(Auth::user()->role == 'admin')
                    <li><a href="/users"><i class="fa fa-users"></i> Users </a></li>
                @endif
            @endif
            @if(Auth::user()->role == 'viewer' || Auth::user()->role == 'editor' || Auth::user()->role == 'admin')
                <li><a href="/share-scholars"><i class="fas fa-laptop"></i> Share Scholars Social Media </a></li>
            @endif
        </ul>

    </div>
</div>
