<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            @if ($restaurant)
                <span class="align-middle">{{ $restaurant->name }}</span>
            @else
                <span class="align-middle">ClicknEat</span>
            @endif
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item {{ request()->routeIs('manager.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('manager.index') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Mon Restaurant</span>
                </a>
            </li>

            @if ($restaurant)
            <li class="sidebar-item {{ request()->routeIs('manager.categories.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('manager.categories.index') }}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Mes Categories</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('manager.items.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('manager.items.index') }}">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Mes Items</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('manager.commandes.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('manager.commandes.index') }}">
                    <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Mes Commandes</span>
                </a>
            </li>
            @endif

            <li class="sidebar-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a class="sidebar-link" href="#" onclick="document.getElementById('logout-form').submit();">
                        <i class="align-middle" data-feather="log-out"></i> <span class="align-middle">Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </div>
</nav>