@extends('layouts.dokter')

@section('title', 'Dokter Dashboard')

@section('content')
<main>
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Pasien Hari Ini</p>
                    <h3 class="text-2xl font-bold text-gray-800">24</h3>
                </div>
                <div class="bg-blue-50 rounded-full p-3">
                    <i class="fas fa-user-group text-blue-500 text-xl"></i>
                </div>
            </div>
            <p class="text-xs text-green-500 mt-2">
                <i class="fas fa-arrow-up"></i> 12% dari kemarin
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Sudah Diperiksa</p>
                    <h3 class="text-2xl font-bold text-gray-800">18</h3>
                </div>
                <div class="bg-green-50 rounded-full p-3">
                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                </div>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 mt-3">
                <div class="bg-green-500 h-2.5 rounded-full" style="width: 75%"></div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Dalam Antrian</p>
                    <h3 class="text-2xl font-bold text-gray-800">6</h3>
                </div>
                <div class="bg-yellow-50 rounded-full p-3">
                    <i class="fas fa-clock text-yellow-500 text-xl"></i>
                </div>
            </div>
            <p class="text-xs text-yellow-500 mt-2">
                Estimasi waktu tunggu: 45 menit
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Rata-rata Waktu</p>
                    <h3 class="text-2xl font-bold text-gray-800">18m</h3>
                </div>
                <div class="bg-purple-50 rounded-full p-3">
                    <i class="fas fa-stopwatch text-purple-500 text-xl"></i>
                </div>
            </div>
            <p class="text-xs text-purple-500 mt-2">
                Per pasien hari ini
            </p>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Current Patient Card -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Pasien Saat Ini</h2>
                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm">
                        Dalam Pemeriksaan
                    </span>
                </div>
                <div class="flex items-center space-x-4 mb-6">
                    <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150&h=150&fit=crop"
                        class="w-16 h-16 rounded-full" alt="Patient">
                    <div>
                        <h3 class="font-semibold text-lg">Sarah Johnson</h3>
                        <p class="text-gray-500">32 tahun • Wanita</p>
                        <p class="text-sm text-blue-500">Keluhan: Nyeri dada dan sesak napas</p>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="border rounded-lg p-3">
                        <p class="text-sm text-gray-500">Tekanan Darah</p>
                        <p class="font-semibold">120/80 mmHg</p>
                    </div>
                    <div class="border rounded-lg p-3">
                        <p class="text-sm text-gray-500">Detak Jantung</p>
                        <p class="font-semibold">85 bpm</p>
                    </div>
                    <div class="border rounded-lg p-3">
                        <p class="text-sm text-gray-500">Suhu Tubuh</p>
                        <p class="font-semibold">36.5°C</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <button class="flex-1 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors">
                        Catat Pemeriksaan
                    </button>
                    <button class="flex-1 border border-gray-300 py-2 px-4 rounded-lg hover:bg-gray-50 transition-colors">
                        Riwayat Medis
                    </button>
                </div>
            </div>
        </div>

        <!-- Queue List -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Antrian Berikutnya</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <span class="text-lg font-bold text-blue-500">1</span>
                        <div>
                            <h4 class="font-medium">John Smith</h4>
                            <p class="text-sm text-gray-500">09:30 AM</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">
                        Menunggu
                    </span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <span class="text-lg font-bold text-blue-500">2</span>
                        <div>
                            <h4 class="font-medium">Emma Davis</h4>
                            <p class="text-sm text-gray-500">10:00 AM</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">
                        Menunggu
                    </span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <span class="text-lg font-bold text-blue-500">3</span>
                        <div>
                            <h4 class="font-medium">Michael Brown</h4>
                            <p class="text-sm text-gray-500">10:30 AM</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">
                        Menunggu
                    </span>
                </div>
            </div>
            <button class="w-full mt-6 text-blue-500 hover:text-blue-600 text-sm font-medium">
                Lihat Semua Antrian →
            </button>
        </div>

        <!-- Recent Activity -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Aktivitas Terakhir</h2>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 border rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-filter mr-2"></i> Filter
                        </button>
                        <button class="px-3 py-1 border rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-download mr-2"></i> Export
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3 px-4">Waktu</th>
                                <th class="text-left py-3 px-4">Pasien</th>
                                <th class="text-left py-3 px-4">Tindakan</th>
                                <th class="text-left py-3 px-4">Status</th>
                                <th class="text-left py-3 px-4">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="py-3 px-4">09:15 AM</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-3">
                                        <img src="https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?w=50&h=50&fit=crop"
                                            class="w-8 h-8 rounded-full">
                                        <span>Robert Chen</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">Pemeriksaan Rutin</td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                        Selesai
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <button class="text-blue-500 hover:text-blue-700">Lihat</button>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-3 px-4">08:45 AM</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-3">
                                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=50&h=50&fit=crop"
                                            class="w-8 h-8 rounded-full">
                                        <span>Maria Garcia</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">Konsultasi</td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                        Selesai
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <button class="text-blue-500 hover:text-blue-700">Lihat</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add hover effect to cards
        const cards = document.querySelectorAll('.rounded-xl');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.classList.add('hover:shadow-md');
            });
            card.addEventListener('mouseleave', () => {
                card.classList.remove('hover:shadow-md');
            });
        });

        // Animate number counters
        const numbers = document.querySelectorAll('.text-2xl');
        numbers.forEach(number => {
            const finalValue = parseInt(number.textContent);
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
        });
    });
</script>
@endsection