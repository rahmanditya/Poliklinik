@extends('layouts.app')

@section('title', 'Poliklinik Login')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ ucfirst($role) }}</title>
    @vite('resources/css/app.css')
</head>

<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-500 to-blue-700">
    <div class="area absolute inset-0 z-0">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>

    <!-- Login Card -->
    <div class="login-container bg-white shadow-lg rounded-lg p-6 sm:p-8 w-full max-w-md z-10 relative">
        <p class="text-gray-600 text-center mt-2">
            Login sebagai <strong class="text-gray-800">{{ ucfirst($role) }}</strong>
        </p>

        <form action="{{ route('login.post') }}" method="POST" class="space-y-6 mt-4">
            @csrf
            <input type="hidden" name="role" value="{{ $role }}">
            <!-- Email Input -->
            <div>
                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    value="{{ old('email') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    required>
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Password Input -->
            <div>
                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    required>
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ "Password minimal 6 karakter." }}</p>
                @enderror
            </div>
            @error('login_error')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg">Login</button>
        </form>
    </div>
</body>

</html>
@endsection