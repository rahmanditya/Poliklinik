<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokter</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body>
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('dokter.dashboard') }}" class="{{ Request::is('dokter/dashboard') ? 'active' : '' }}">
                        <span class="las la-home"></span><span>Dashboard</span>
                    </a>
                </li>
                </li>
                <li>
                    <a href="{{ route('dokter.schedule.index') }}" class="{{ Request::is('dokter/schedule*') ? 'active' : '' }}">
                        <span class="las la-calendar"></span><span>Jadwal Periksa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dokter.periksa.index') }}" class="{{ Request::is('dokter/periksa*') ? 'active' : '' }}">
                        <span class="las la-clipboard-check"></span><span>Periksa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dokter.riwayat.index') }}" class="{{ Request::is('dokter/riwayat*') ? 'active' : '' }}">
                        <span class="las la-history"></span><span>Riwayat</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dokter.profil.index') }}" class="{{ Request::is('dokter/profil*') ? 'active' : '' }}">
                        <span class="las la-user"></span><span>Profil</span>
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
                Halo {{ $user->name ?? 'Tidak Diketahui' }}
            </h5>

            <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="Cari disini">
            </div>

            <!-- Logout Button -->
            <form action="{{ route('dokter.logout') }}" method="POST" style="display: inline;">
                @csrf
                <button class="logout-btn">
                    <div class="icon"></div>
                    <div class="text">Logout</div>
                </button>
            </form>

        </header>
        <!-- Main Content -->
        @yield('content')
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const sidebar = document.querySelector(".sidebar");
            const header = document.querySelector("header");

            // Check localStorage for initial load
            if (!sessionStorage.getItem("hasAnimated")) {
                // Add animation classes
                sidebar.classList.add("animated");
                header.classList.add("animated");

                // Store a flag to indicate animation has run
                sessionStorage.setItem("hasAnimated", "true");
            }
        });
    </script>
    @stack('scripts')
</body>