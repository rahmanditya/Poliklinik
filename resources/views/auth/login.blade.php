@extends('layouts.app')

@section('title', 'Poliklinik Login')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ ucfirst($role) }}</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">
    <div class="area absolute inset-0 z-0">
        <ul class="circles">
            @for ($i = 1; $i <= 10; $i++)
                <li>
                </li>
                @endfor
        </ul>
    </div>

    <div class="login-container rounded-xl p-8 w-full max-w-md z-10 relative">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang</h1>
            <p class="text-gray-600">
                Login sebagai <strong class="text-blue-600">{{ ucfirst($role) }}</strong>
            </p>
        </div>

        <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="role" value="{{ $role }}">

            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Masukkan Email"
                        value="{{ old('email') }}"
                        class="input-field"
                        required>
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan Password"
                        class="input-field"
                        required>
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ "Password minimal 6 karakter." }}</p>
                    @enderror
                </div>
            </div>

            @error('login_error')
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                <p class="text-red-700 text-sm">{{ $message }}</p>
            </div>
            @enderror

            <button type="submit" class="login-button">
                Sign In
            </button>

            @if ($role === 'pasien')
            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register.index') }}" class="text-blue-500 hover:text-blue-600 font-medium hover:underline transition-colors">
                        Daftar di sini
                    </a>
                </p>
            </div>
            @endif
        </form>
    </div>

    <script>
        // Add smooth fade-in animation when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.login-container').style.opacity = '0';
            setTimeout(() => {
                document.querySelector('.login-container').style.transition = 'opacity 0.5s ease-in-out';
                document.querySelector('.login-container').style.opacity = '1';
            }, 100);
        });
    </script>
</body>

</html>
@endsection