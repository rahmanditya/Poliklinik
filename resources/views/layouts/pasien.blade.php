<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasien</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body>
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="las la-user-circle"></span>
                <span>Poliklinik</span>
            </h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('pasien.dashboard') }}" class="active {{ Request::is('pasien/dashboard') ? 'active' : '' }}">
                        <span class="las la-igloo"></span><span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pasien.poli.index') }}" class="{{ Request::is('pasien/poli/index') ? 'active' : '' }}">
                        <span class="las la-clinic-medical"></span><span>Poli</span>
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

                Dashboard Pasien
            </h5>

            <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="Cari disini">
            </div>

            <form action="{{ route('pasien.logout') }}" method="POST" style="display: inline;">
                @csrf
                <button class="logout-btn">
                    <div class="icon"></div>
                    <div class="text">Logout</div>
                </button>
            </form>

        </header>

        <!-- Main Content -->
        @yield('content')

        <script></script>
</body>