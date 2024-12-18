<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasien</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
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
                    <a href="{{ route('pasien.dashboard') }}" class="{{ Request::is('pasien/dashboard') ? 'active' : '' }}">
                        <span class="las la-igloo"></span><span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pasien.poli.index') }}" class="{{ Request::is('pasien/poli*') ? 'active' : '' }}">
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
                <span class="user-name">{{ $user->name ?? 'Tidak Diketahui' }}</span>
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


            <!-- Notifications -->
            @if (session('success'))
            <div id="successNotification" class="notification fixed top-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-lg z-50">
                <div class="flex items-center">
                    <div class="py-1">
                        <svg class="h-6 w-6 text-green-500 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Sukses!</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                    <button onclick="closeNotification('successNotification')" class="ml-4">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            @endif

            @if ($errors->any())
            <div id="errorNotification" class="notification fixed top-4 right-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-lg z-50">
                <div class="flex items-center">
                    <div class="py-1">
                        <svg class="h-6 w-6 text-red-500 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Error!</p>
                        <p class="text-sm">{{ $errors->first() }}</p>
                    </div>
                    <button onclick="closeNotification('errorNotification')" class="ml-4">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            @endif

        </header>
        <!-- Main Content -->
        @yield('content')
    </div>

    @include('layouts.partials.scripts')
    @stack('scripts')
</body>