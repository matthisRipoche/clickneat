<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">ClicknEat</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('dashboard.index') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('restaurants.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('restaurants.index') }}">
                    <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Restaurants</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('categories.index') }}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Categories</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('items.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('items.index') }}">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Items</span>
                </a>
            </li>

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