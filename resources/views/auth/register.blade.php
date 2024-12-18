@extends('layouts.app')

@section('title', 'Poliklinik Registration')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pasien</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    <div class="area absolute inset-0 z-0">
        <ul class="circles">
            @for ($i = 1; $i <= 10; $i++)
                <li>
                </li>
                @endfor
        </ul>
    </div>

    <div class="register-container rounded-2xl p-8 w-full max-w-md z-10 relative">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Daftar Akun Baru</h1>
            <p class="text-gray-600">
                Silahkan lengkapi data diri Anda
            </p>
        </div>

        <div class="form-container">
            <form action="{{ route('register.post') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="role" value="pasien">

                <div class="space-y-5">

                    <div>
                        <input id="medical_record_number" name="medical_record_number" type="text" required
                            class="input-field peer pt-8 pb-2"
                            value="{{ old('medical_record_number') }}"
                            placeholder="Nomor Rekam Medis">
                        @error('medical_record_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <input id="name" name="name" type="text" required
                            class="input-field peer pt-8 pb-2"
                            value="{{ old('name') }}"
                            placeholder="Nama">
                        @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <input id="email" name="email" type="email" required
                            class="input-field peer pt-8 pb-2"
                            value="{{ old('email') }}"
                            placeholder="Email ">
                        @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No Telp -->
                    <div>
                        <input id="phone" name="phone" type="tel" required
                            class="input-field peer pt-8 pb-2"
                            value="{{ old('phone') }}"
                            placeholder="No Telepon">
                        @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Masukkan Tanggal Lahir</label>
                        <input id="date_of_birth" name="date_of_birth" type="date" required
                            class="input-field peer pt-8 pb-2"
                            value="{{ old('date_of_birth') }}"
                            placeholder=" ">
                        @error('date_of_birth')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div>
                        <textarea id="address" name="address" rows="3" required
                            class="input-field peer pt-8 pb-2 min-h-[100px]"
                            placeholder="Alamat">{{ old('address') }}</textarea>
                        @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <input id="password" name="password" type="password" required
                        class="input-field peer pt-8 pb-2"
                        placeholder="Password">
                    @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="input-field peer pt-8 pb-2"
                        placeholder="Masukkan Ulang Password">
                </div>


                @if(session('error'))
                <div class="rounded-md bg-red-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <button type="submit"
                    class="register-button w-full py-3 px-4 rounded-lg text-white font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform transition-all duration-300">
                    Daftar Sekarang
                </button>
            </form>

            <div class="text-center mt-6">
                <p class="text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login.index', ['role' => 'pasien']) }}"
                        class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-300">
                        Login di sini
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.register-container');
            container.style.opacity = '0';
            container.style.transform = 'translateY(20px)';

            setTimeout(() => {
                container.style.transition = 'all 0.5s ease-out';
                container.style.opacity = '1';
                container.style.transform = 'translateY(0)';
            }, 100);

            // Floating label animation
            const inputs = document.querySelectorAll('.input-field');
            inputs.forEach(input => {
                if (input.value) {
                    input.classList.add('has-value');
                }
                input.addEventListener('input', function() {
                    if (this.value) {
                        this.classList.add('has-value');
                    } else {
                        this.classList.remove('has-value');
                    }
                });
            });
        });
    </script>
</body>

</html>
@endsection