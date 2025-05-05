<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">
            <span class="align-middle">Dashboard</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Menu
            </li>

            <li class="sidebar-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li
                class="sidebar-item {{ Illuminate\Support\Str::startsWith(Route::currentRouteName(), 'admin.recipes.') ? 'active' : '' }}">
                <a class="sidebar-link " href="{{ route('admin.recipes.index') }}">
                    <i class="align-middle" data-feather="database"></i> <span class="align-middle">Recipes</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
