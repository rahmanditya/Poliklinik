@extends('layouts.admin')

@section('title', 'Tambah Dokter')

@section('content')
<main class="min-h-screen bg-gradient-to-br from-blue-50 to-white light:from-gray-900 light:to-gray-800">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <!-- Header with animation -->
            <div class="text-center mb-10 animate-fade-in">
                <h1 class="text-3xl font-bold text-gray-800 light:text-white mb-2">Tambah Dokter</h1>
                <p class="text-gray-600 light:text-gray-300">Lengkapi informasi dokter baru</p>
            </div>

            <!-- Form Card with shadow and animation -->
            <div class="bg-white light:bg-gray-800 rounded-xl shadow-lg p-8 animate-scale-in">
                <form action="{{ route('admin.dokter.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Name Input with floating label and animation -->
                    <div class="form-group transform transition-all duration-300 ease-in-out hover:translate-x-1">
                        <div class="relative">
                            <input type="text" name="name" id="name" autocomplete="off"
                                class="peer w-full border-b-2 border-gray-300 bg-transparent pt-4 pb-1.5 text-gray-900 light:text-white placeholder-transparent focus:border-blue-500 focus:outline-none"
                                placeholder="Nama Dokter" required />
                            <label for="name"
                                class="absolute left-0 -top-1 text-gray-600 text-sm transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:-top-1 peer-focus:text-blue-500 peer-focus:text-sm light:text-gray-400">
                                Nama Dokter
                            </label>
                        </div>
                    </div>

                    <!-- Email Input -->
                    <div class="form-group transform transition-all duration-300 ease-in-out hover:translate-x-1">
                        <div class="relative">
                            <input type="email" name="email" id="email" autocomplete="off"
                                class="peer w-full border-b-2 border-gray-300 bg-transparent pt-4 pb-1.5 text-gray-900 light:text-white placeholder-transparent focus:border-blue-500 focus:outline-none"
                                placeholder="Email" required />
                            <label for="email"
                                class="absolute left-0 -top-1 text-gray-600 text-sm transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:-top-1 peer-focus:text-blue-500 peer-focus:text-sm light:text-gray-400">
                                Email
                            </label>
                        </div>
                    </div>

                    <!-- Specialization Selection -->
                    <div class="form-group space-y-3">
                        <label class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-2">
                            Pilih Poli
                        </label>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($specializations as $specialization)
                            <div class="relative">
                                <input type="radio" id="specialization_{{ $specialization->id }}"
                                    name="specialization_id" value="{{ $specialization->id }}"
                                    class="peer hidden" required />
                                <label for="specialization_{{ $specialization->id }}"
                                    class="flex items-center p-3 text-gray-700 bg-gray-50 border border-gray-200 rounded-lg cursor-pointer transition-all duration-200 ease-in-out peer-checked:bg-blue-50 peer-checked:border-blue-500 hover:bg-gray-100 light:bg-gray-700 light:border-gray-600 light:text-white light:hover:bg-gray-600 light:peer-checked:bg-blue-900">
                                    <div class="block">
                                        <div class="w-full text-sm">{{ $specialization->name }}</div>
                                    </div>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Phone Input -->
                    <div class="form-group transform transition-all duration-300 ease-in-out hover:translate-x-1">
                        <div class="relative">
                            <input type="tel" name="phone" id="phone" autocomplete="off"
                                class="peer w-full border-b-2 border-gray-300 bg-transparent pt-4 pb-1.5 text-gray-900 light:text-white placeholder-transparent focus:border-blue-500 focus:outline-none"
                                placeholder="No. Telp" required />
                            <label for="phone"
                                class="absolute left-0 -top-1 text-gray-600 text-sm transition-all peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:-top-1 peer-focus:text-blue-500 peer-focus:text-sm light:text-gray-400">
                                No. Telp
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('admin.dokter.index') }}" 
                            class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-all duration-300 ease-in-out transform hover:-translate-y-1 light:bg-gray-700 light:text-gray-300 light:hover:bg-gray-600">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg light:bg-blue-700 light:hover:bg-blue-600">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<style>
    .animate-fade-in {
        animation: fadeIn 0.6s ease-out;
    }
    
    .animate-scale-in {
        animation: scaleIn 0.4s ease-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .form-group {
        opacity: 0;
        animation: slideIn 0.5s ease-out forwards;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .form-group:nth-child(1) { animation-delay: 0.1s; }
    .form-group:nth-child(2) { animation-delay: 0.2s; }
    .form-group:nth-child(3) { animation-delay: 0.3s; }
    .form-group:nth-child(4) { animation-delay: 0.4s; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    
    form.addEventListener('submit', function(e) {
        const button = this.querySelector('button[type="submit"]');
        button.disabled = true;
        button.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Menyimpan...
        `;
    });

    // Add ripple effect to buttons
    const buttons = document.querySelectorAll('button, .btn');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const x = e.clientX - e.target.offsetLeft;
            const y = e.clientY - e.target.offsetTop;

            const ripples = document.createElement('span');
            ripples.style.left = x + 'px';
            ripples.style.top = y + 'px';
            this.appendChild(ripples);

            setTimeout(() => {
                ripples.remove();
            }, 1000);
        });
    });
});
</script>
@endsection