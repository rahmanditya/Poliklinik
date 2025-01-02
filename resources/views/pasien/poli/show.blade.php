@extends('layouts.pasien')

@section('title', 'Daftar Poli')

@section('content')
<main>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900">Daftar Poli {{ $poli->name }}</h1>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Registration Form -->
            <div class="lg:w-1/3">
                <form action="{{ route('pasien.poli.store') }}" method="POST" class="bg-white rounded-lg shadow-sm p-6">
                    @csrf
                    <input type="hidden" name="pasien_id" value="{{ $user->pasien->id }}">
                    <input type="hidden" name="no_antrian" id="queue_number_input">

                    @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Medical Record Number -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nomor Rekam Medis
                        </label>
                        <input type="text"
                            value="{{ $medical_record_number }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-500"
                            disabled
                            readonly />
                    </div>

                    <!-- Doctor Selection -->
                    <div class="mb-6">
                        <label for="dokter_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Pilih Dokter
                        </label>
                        <select name="dokter_id" id="dokter_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled selected>Pilih Dokter</option>
                            @foreach($dokters as $dokter)
                            <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Schedule Selection -->
                    <div class="mb-6">
                        <label for="schedule_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Pilih Jadwal
                        </label>
                        <select name="schedule_id" id="schedule_id" required disabled
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled selected>Pilih Jadwal</option>
                            @foreach($activeSchedules as $schedule)
                            <option value="{{ $schedule->id }}" data-dokter="{{ $schedule->dokter_id }}">
                                {{ \Carbon\Carbon::parse($schedule->formatted_hari)->translatedFormat('l, d F') }}
                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Queue Number Display -->
                    <div class="mb-6">
                        <div id="queue-preview" class="text-center text-lg font-semibold text-blue-600"></div>
                    </div>

                    <!-- Complaint Field -->
                    <div class="mb-6">
                        <label for="keluhan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Keluhan
                        </label>
                        <textarea name="keluhan" id="keluhan" rows="4" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                        Daftar
                    </button>
                </form>
            </div>

            <!-- Appointment History Table -->
            <div class="lg:w-2/3">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Riwayat Pendaftaran</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poli</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dokter</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jadwal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mulai</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Selesai</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Antrian</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detail</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($user->pasien->daftarPoli ?? [] as $periksa)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $periksa->dokter->poli->name ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $periksa->dokter->name ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Illuminate\Support\Str::ucfirst($periksa->schedule->hari ?? '-') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Carbon\Carbon::parse($periksa->schedule->start_time ?? now())->format('H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Carbon\Carbon::parse($periksa->schedule->end_time ?? now())->format('H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $periksa->no_antrian }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $periksa->status === 'selesai' ? 'bg-green-100 text-green-800' : 
                                       ($periksa->status === 'dalam_antrian' ? 'bg-yellow-100 text-yellow-800' : 
                                       'bg-gray-100 text-gray-800') }}">
                                                {{ ucfirst(str_replace('_', ' ', $periksa->status ?? 'unknown')) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($periksa->status === 'selesai')
                                            <button
                                                class="text-blue-600 hover:underline focus:outline-none"
                                                onclick="openDetailModal('{{ $periksa->id }}')">
                                                Lihat Detail
                                            </button>
                                            @else
                                            <span class="text-gray-600">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            Belum ada pendaftaran poli
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<div id="detailModal" class="hidden fixed z-50 inset-0 hidden overflow-y-auto bg-black bg-opacity-50">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-lg max-w-lg w-full">
            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Detail Periksa</h2>
            </div>
            <div class="px-6 py-4">
                <p><strong>Dokter : </strong> <span id="dokterName"></span></p>
                <div class="mt-4">
                    <p class="font-semibold">Obat yang Diberikan : </p>
                    <ul id="obatList" class="list-disc pl-5"></ul>
                </div>
                <div class="mt-4">
                    <p class="font-semibold">Catatan Dokter : </p>
                    <p id="catatanDokter" class="text-gray-700"></p>
                </div>
                <p><strong>Biaya Periksa : </strong> <span id="biayaPeriksa"></span></p>
                <ul id="obatList" class="list-disc pl-5"></ul>
            </div>
            <div class="px-6 py-4 border-t">
                <button
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"
                    onclick="closeDetailModal()">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const dokterSelect = document.getElementById('dokter_id');
        const scheduleSelect = document.getElementById('schedule_id');
        const queueNumberInput = document.querySelector('input[name="no_antrian"]');

        dokterSelect.addEventListener('change', function() {
            const selectedDokterId = this.value;
            scheduleSelect.value = '';
            queueNumberInput.value = '';
            document.getElementById('queue-preview').textContent = '';

            Array.from(scheduleSelect.options).forEach(option => {
                if (option.value === '') return;
                const dokterIdForSchedule = option.getAttribute('data-dokter');
                option.style.display = dokterIdForSchedule === selectedDokterId ? '' : 'none';
            });

            scheduleSelect.disabled = false;
        });

        scheduleSelect.addEventListener('change', async function() {
            const selectedScheduleId = this.value;
            const selectedDokterId = dokterSelect.value;

            if (selectedScheduleId && selectedDokterId) {
                try {
                    const response = await fetch(`/api/queue-number?schedule_id=${selectedScheduleId}&dokter_id=${selectedDokterId}`);
                    if (!response.ok) throw new Error('Network response was not ok');

                    const data = await response.json();
                    queueNumberInput.value = data.queueNumber;
                    document.getElementById('queue-preview').textContent = `Nomor Antrian Anda: ${data.queueNumber}`;
                } catch (error) {
                    console.error('Error fetching queue number:', error);
                    alert('Gagal mengambil nomor antrian. Silakan coba lagi.');
                }
            }
        });
    });

    function openDetailModal(periksaId) {
        fetch(`/pasien/poli/${periksaId}/detail`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                    return;
                }

                document.getElementById('dokterName').textContent = data.dokterName || '-';

                // Parse "Obat yang diberikan" and "Catatan Dokter" from `catatan`
                const catatan = data.catatan || '';
                const obatRegex = /Obat yang diberikan:([\s\S]*?)Catatan Dokter:/i;
                const dokterCatatanRegex = /Catatan Dokter:([\s\S]*)/i;

                const obatMatch = catatan.match(obatRegex);
                const dokterCatatanMatch = catatan.match(dokterCatatanRegex);

                const obatList = document.getElementById('obatList');
                obatList.innerHTML = '';
                if (obatMatch && obatMatch[1]) {
                    const obatItems = obatMatch[1].trim().split(/\d+\.\s+/).filter(Boolean);
                    obatItems.forEach(obat => {
                        const li = document.createElement('li');
                        li.textContent = obat.trim();
                        obatList.appendChild(li);
                    });
                }

                document.getElementById('catatanDokter').textContent = dokterCatatanMatch && dokterCatatanMatch[1] ? dokterCatatanMatch[1].trim() : '-';
                document.getElementById('biayaPeriksa').textContent = data.biayaPeriksa ? `Rp ${data.biayaPeriksa}` : '-';

                document.getElementById('detailModal').classList.remove('hidden');
            })
            .catch(error => console.error('Error fetching details:', error));
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }
</script>
@endsection