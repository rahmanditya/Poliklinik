<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @include('layouts.partials.styles')
    @yield('styles')
</head>

<body>
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <span class="las la-igloo"></span><span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dokter.index') }}" class="{{ Request::is('admin/dokter*') ? 'active' : '' }}">
                        <span class="las la-stethoscope"></span><span>Dokter</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pasien.index') }}" class="{{ Request::is('admin/pasien*') ? 'active' : '' }}">
                        <span class="las la-user-injured"></span><span>Pasien</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.poli.index') }}" class="{{ Request::is('admin/poli*') ? 'active' : '' }}">
                        <span class="las la-clinic-medical"></span><span>Poli</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.obat.index') }}" class="{{ Request::is('admin/obat*') ? 'active' : '' }}">
                        <span class="las la-capsules"></span><span>Obat</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h5>
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                </label>
                <span class="user-name">{{ $user->name ?? 'Tidak Diketahui' }}</span>
            </h5>

            <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="Cari disini">
            </div>

            <!-- Logout Button -->
            <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                @csrf
                <button class="logout-btn">
                    <div class="icon"></div>
                    <div class="text">Logout</div>
                </button>
            </form>

        </header>
        @yield('content')
    </div>

    @include('layouts.partials.scripts')
    @stack('scripts')
</body>

</html>