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

    <!-- Login Card -->
    <div class="login-container bg-white shadow-lg rounded-lg p-6 sm:p-8 w-full max-w-md">
        <p class="text-gray-600 text-center mt-2">
            Login sebagai <strong class="text-gray-800">{{ ucfirst($role) }}</strong>
        </p>

        <form action="{{ route('login.post') }}" method="POST" class="space-y-6 mt-4">
            @csrf
            <input type="hidden" name="role" value="{{ $role }}">
            <input type="hidden" name="role_id" value="{{ $roleId }}">
            <!-- Email Input -->
            <div>
                <input 
                    type="email" 
                    name="email" 
                    placeholder="Email" 
                    value="{{ old('email') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    required
                >
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
                    required
                >
                @error('password')
                    <p class="text-red-500 text-sm mt-1">Password kurang dari 6 karakter.</p>
                @enderror
            </div>

                <!-- Error Message -->
                @if ($errors->has('login_error'))
                    <p class="text-red-500 text-sm text-center mt-2">{{ $errors->first('login_error') }}</p>
                @endif
                
            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition"
            >
                Log In
            </button>
        </form>
    </div>

</body>
</html>
@endsection
