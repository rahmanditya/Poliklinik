@extends('layouts.dokter')

@section('title', 'Profil Dokter')

@section('content')
<main>
    <div class="container mx-auto px-4 max-w-4xl">
        <!-- Profile Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-300 hover:shadow-2xl">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                <h2 class="text-3xl font-bold text-white mb-2">Profil</h2>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert-error" role="alert">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Section -->
            <form action="{{ route('dokter.profil.update') }}" method="POST" id="profileForm" class="p-8">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Basic Information -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Informasi Dasar</h3>
                        
                        <div class="dokter-profil">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $dokter->name) }}" required>
                        </div>

                        <div class="dokter-profil">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $dokter->email) }}" required>
                        </div>

                        <div class="dokter-profil">
                            <label for="phone">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone', $dokter->phone) }}" required>
                        </div>

                        <div class="dokter-profil">
                            <label for="specialization_id">Poli/Spesialisasi</label>
                            <select id="specialization_id" name="specialization_id" required>
                                <option value="">Pilih Poli</option>
                                @foreach($poli as $p)
                                    <option value="{{ $p->id }}" {{ old('specialization_id', $dokter->specialization_id) == $p->id ? 'selected' : '' }}>
                                        {{ $p->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="dokter-profil">
                            <label for="status">Status</label>
                            <select id="status" name="status">
                                <option value="Tersedia" {{ old('status', $dokter->status) == 'Tersedia' ? 'selected' : '' }}>
                                    Tersedia
                                </option>
                                <option value="Tidak Tersedia" {{ old('status', $dokter->status) == 'Tidak Tersedia' ? 'selected' : '' }}>
                                    Tidak Tersedia
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Password Section -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Ubah Password</h3>
                        
                        <div class="dokter-profil">
                            <label for="current_password">Password Saat Ini</label>
                            <input type="password" id="current_password" name="current_password">
                            <small>Kosongkan jika tidak ingin mengubah password</small>
                        </div>

                        <div class="dokter-profil">
                            <label for="new_password">Password Baru</label>
                            <input type="password" id="new_password" name="new_password">
                            <div class="password-strength" id="passwordStrength"></div>
                        </div>

                        <div class="dokter-profil">
                            <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation">
                        </div>
                    </div>
                </div>

                <div class="mt-8 text-right">
                    <button type="submit" class="submit-button">
                        <span class="button-text">Simpan Perubahan</span>
                        <svg class="button-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('profileForm');
    const currentPassword = document.getElementById('current_password');
    const newPassword = document.getElementById('new_password');
    const confirmPassword = document.getElementById('new_password_confirmation');
    const strengthIndicator = document.getElementById('passwordStrength');

    // Password Strength Checker
    function checkPasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
        if (password.match(/\d/)) strength++;
        if (password.match(/[^a-zA-Z\d]/)) strength++;
        
        strengthIndicator.className = 'password-strength';
        if (strength === 0) strengthIndicator.style.width = '0';
        else if (strength <= 2) strengthIndicator.classList.add('strength-weak');
        else if (strength === 3) strengthIndicator.classList.add('strength-medium');
        else strengthIndicator.classList.add('strength-strong');
    }

    newPassword.addEventListener('input', function() {
        checkPasswordStrength(this.value);
    });

    // Form Validation
    form.addEventListener('submit', function(e) {
        const inputs = [currentPassword, newPassword, confirmPassword];
        inputs.forEach(input => input.classList.remove('border-red-500'));

        if (newPassword.value || currentPassword.value || confirmPassword.value) {
            let hasError = false;

            if (!currentPassword.value) {
                currentPassword.classList.add('border-red-500');
                hasError = true;
            }

            if (newPassword.value && newPassword.value.length < 8) {
                newPassword.classList.add('border-red-500');
                hasError = true;
            }

            if (newPassword.value !== confirmPassword.value) {
                confirmPassword.classList.add('border-red-500');
                hasError = true;
            }

            if (hasError) {
                e.preventDefault();
                showNotification('Mohon periksa kembali form password Anda', 'error');
            }
        }
    });

    // Phone number validation with formatting
    const phoneInput = document.getElementById('phone');
    phoneInput.addEventListener('input', function(e) {
        let value = this.value.replace(/\D/g, '');
        if (value.length > 0) {
            if (value.length <= 4) {
                this.value = value;
            } else if (value.length <= 8) {
                this.value = value.slice(0,4) + '-' + value.slice(4);
            } else {
                this.value = value.slice(0,4) + '-' + value.slice(4,8) + '-' + value.slice(8,12);
            }
        }
    });

    // Custom notification function
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `alert-${type} fixed top-4 right-4 z-50 transform transition-all duration-300`;
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    // Add loading state to submit button
    form.addEventListener('submit', function() {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="animate-spin h-5 w-5 mr-3" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Menyimpan...
        `;
    });
});
</script>

@endsection