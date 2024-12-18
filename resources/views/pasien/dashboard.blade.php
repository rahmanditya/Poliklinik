@extends('layouts.pasien')

@section('title', 'Pasien Dashboard')

@section('content')

<main>
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg mb-6 p-6">
        <div class="flex items-center justify-between">
            <div class="text-white">
                <h1 class="text-2xl font-bold mb-2">Selamat Datang, {{ $user->name ?? 'Tidak Diketahui' }}!</h1>
                <p class="opacity-90">Jadwal pemeriksaan berikutnya: 15 Maret 2024, 09:30</p>
            </div>
            <div class="hidden md:flex items-center space-x-3">
                <button class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition-colors">
                    <i class="fas fa-calendar-plus mr-2"></i>Buat Janji
                </button>
                <button class="bg-blue-400 text-white px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                    <i class="fas fa-phone mr-2"></i>Bantuan
                </button>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition-all cursor-pointer border-l-4 border-emerald-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">No. Antrian Anda</p>
                    <h3 class="text-2xl font-bold text-gray-800">05</h3>
                    <p class="text-xs text-emerald-500 mt-1">Estimasi: 25 menit</p>
                </div>
                <div class="bg-emerald-50 rounded-full p-3">
                    <i class="fas fa-ticket text-emerald-500 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition-all cursor-pointer border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Resep Aktif</p>
                    <h3 class="text-2xl font-bold text-gray-800">2</h3>
                    <p class="text-xs text-purple-500 mt-1">Perlu perpanjangan</p>
                </div>
                <div class="bg-purple-50 rounded-full p-3">
                    <i class="fas fa-prescription text-purple-500 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition-all cursor-pointer border-l-4 border-orange-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Hasil Lab</p>
                    <h3 class="text-2xl font-bold text-gray-800">3</h3>
                    <p class="text-xs text-orange-500 mt-1">1 hasil baru</p>
                </div>
                <div class="bg-orange-50 rounded-full p-3">
                    <i class="fas fa-flask text-orange-500 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition-all cursor-pointer border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Tagihan</p>
                    <h3 class="text-2xl font-bold text-gray-800">0</h3>
                    <p class="text-xs text-blue-500 mt-1">Semua lunas</p>
                </div>
                <div class="bg-blue-50 rounded-full p-3">
                    <i class="fas fa-receipt text-blue-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Upcoming Appointments -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Jadwal Pemeriksaan</h2>
                    <button class="text-blue-500 hover:text-blue-700">
                        Lihat Semua
                    </button>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center p-4 bg-blue-50 rounded-lg border border-blue-100">
                        <div class="bg-blue-500 text-white rounded-lg p-3 mr-4">
                            <i class="fas fa-user-doctor text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold">Dr. Sarah Wilson</h4>
                            <p class="text-sm text-gray-500">Pemeriksaan Rutin</p>
                            <p class="text-xs text-blue-500 mt-1">15 Maret 2024 • 09:30 AM</p>
                        </div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">
                                Reschedule
                            </button>
                            <button class="px-3 py-1 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                Konfirmasi
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div class="bg-purple-500 text-white rounded-lg p-3 mr-4">
                            <i class="fas fa-tooth text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold">Dr. John Doe</h4>
                            <p class="text-sm text-gray-500">Pemeriksaan Gigi</p>
                            <p class="text-xs text-gray-500 mt-1">22 Maret 2024 • 14:00 PM</p>
                        </div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">
                                Reschedule
                            </button>
                            <button class="px-3 py-1 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                Konfirmasi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Prescriptions -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Resep Aktif</h2>
                <button class="text-blue-500 hover:text-blue-700">
                    Riwayat Resep
                </button>
            </div>
            <div class="space-y-4">
                <div class="p-4 border rounded-lg">
                    <div class="flex justify-between items-start mb-3">
                        <h4 class="font-semibold">Amoxicillin</h4>
                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Aktif</span>
                    </div>
                    <p class="text-sm text-gray-500">500mg - 3x sehari</p>
                    <p class="text-xs text-gray-400 mt-1">Diresepkan oleh Dr. Sarah Wilson</p>
                    <div class="mt-3 flex justify-between items-center">
                        <p class="text-xs text-orange-500">Sisa: 5 hari</p>
                        <button class="text-sm text-blue-500 hover:text-blue-700">Perpanjang</button>
                    </div>
                </div>

                <div class="p-4 border rounded-lg">
                    <div class="flex justify-between items-start mb-3">
                        <h4 class="font-semibold">Paracetamol</h4>
                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Aktif</span>
                    </div>
                    <p class="text-sm text-gray-500">500mg - jika diperlukan</p>
                    <p class="text-xs text-gray-400 mt-1">Diresepkan oleh Dr. Sarah Wilson</p>
                    <div class="mt-3 flex justify-between items-center">
                        <p class="text-xs text-orange-500">Sisa: 10 hari</p>
                        <button class="text-sm text-blue-500 hover:text-blue-700">Perpanjang</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Health Metrics -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Metrik Kesehatan</h2>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 text-sm border rounded-lg hover:bg-gray-50">
                            Minggu Ini
                        </button>
                        <button class="px-3 py-1 text-sm border rounded-lg hover:bg-gray-50">
                            <i class="fas fa-download mr-1"></i> Export
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="p-4 border rounded-lg">
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-gray-500">Tekanan Darah</p>
                            <i class="fas fa-heart text-red-500"></i>
                        </div>
                        <h3 class="text-2xl font-bold">120/80</h3>
                        <p class="text-xs text-green-500 mt-1">
                            <i class="fas fa-arrow-up"></i> Normal
                        </p>
                    </div>

                    <div class="p-4 border rounded-lg">
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-gray-500">Berat Badan</p>
                            <i class="fas fa-weight-scale text-blue-500"></i>
                        </div>
                        <h3 class="text-2xl font-bold">65 kg</h3>
                        <p class="text-xs text-blue-500 mt-1">
                            <i class="fas fa-minus"></i> Stabil
                        </p>
                    </div>

                    <div class="p-4 border rounded-lg">
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-gray-500">Gula Darah</p>
                            <i class="fas fa-droplet text-purple-500"></i>
                        </div>
                        <h3 class="text-2xl font-bold">95</h3>
                        <p class="text-xs text-green-500 mt-1">
                            <i class="fas fa-check"></i> Normal
                        </p>
                    </div>

                    <div class="p-4 border rounded-lg">
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-gray-500">Kolesterol</p>
                            <i class="fas fa-chart-line text-yellow-500"></i>
                        </div>
                        <h3 class="text-2xl font-bold">180</h3>
                        <p class="text-xs text-yellow-500 mt-1">
                            <i class="fas fa-exclamation-triangle"></i> Perlu Perhatian
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate numbers
        const numbers = document.querySelectorAll('.text-2xl');
        numbers.forEach(number => {
            const finalValue = parseInt(number.textContent);
            if (!isNaN(finalValue)) {
                let currentValue = 0;
                const increment = finalValue / 20;
                const timer = setInterval(() => {
                    currentValue += increment;
                    if (currentValue >= finalValue) {
                        clearInterval(timer);
                        number.textContent = finalValue;
                    } else {
                        number.textContent = Math.round(currentValue);
                    }
                }, 50);
            }
        });

        // Add hover effects to cards
        const cards = document.querySelectorAll('.rounded-xl');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.classList.add('hover:shadow-md');
            });
            card.addEventListener('mouseleave', () => {
                card.classList.remove('hover:shadow-md');
            });
        });
    });
</script>
@endsection