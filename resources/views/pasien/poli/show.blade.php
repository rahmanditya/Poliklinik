@extends('layouts.pasien')

@section('title', 'Dafatar Poli')

@section('content')
<main>
    <div class="header my-3 h-12 px-10 flex items-center justify-between">
        <h1 class="font-medium text-2xl">Daftar Poli {{ $poli->name }}</h1>
    </div>
    <div class="flex flex-col mx-3 mt-6 lg:flex-row">
        <div class="w-full lg:w-1/3 m-1">

            <form action="{{ route('pasien.poli.store') }}" method="POST" class="w-full bg-white shadow-md p-6">
                @csrf

                <!-- Hidden Fields -->
                <input type="hidden" name="pasien_id" value="{{ $user->pasien->id }}">
                <input type="hidden" name="no_antrian" id="queue_number_input">

                <!-- Alert Messages -->
                @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Medical Record Number -->
                <div class="w-full px-3 mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2" for="medical_record_number">
                        Nomor Rekam Medis
                    </label>
                    <input type="text"
                        name="medical_record_number"
                        id="medical_record_number"
                        value="{{ $medical_record_number }}"
                        class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer cursor-not-allowed"
                        disabled
                        readonly />
                </div>

                <!-- Doctor Selection -->
                <div class="w-full px-3 mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2" for="dokter_id">
                        Pilih Dokter di Poli {{ $poli->name }}
                    </label>
                    <select name="dokter_id"
                        id="dokter_id"
                        required
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                        <option value="" disabled selected>Pilih Dokter</option>
                        @foreach($dokters as $dokter)
                        <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Schedule Selection -->
                <div class="w-full px-3 mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2" for="schedule_id">
                        Pilih Jadwal
                    </label>
                    <select name="schedule_id"
                        id="schedule_id"
                        required
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                        <option value="" disabled selected>Pilih Jadwal</option>
                        @foreach($schedules as $schedule)
                        <option value="{{ $schedule->id }}" data-dokter="{{ $schedule->dokter_id }}">
                            {{ \Carbon\Carbon::parse($schedule->date)->format('l, d F Y') }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Queue Number Preview -->
                <div class="w-full px-3 mb-6">
                    <p id="queue-preview" class="text-center text-lg font-semibold text-blue-600"></p>
                </div>

                <!-- Keluhan -->
                <div class="w-full px-3 mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2" for="keluhan">
                        Keluhan
                    </label>
                    <textarea rows="4"
                        id="keluhan"
                        class="appearance-none block w-full bg-white text-gray-900 font-medium border border-gray-400 rounded-lg py-3 px-3 leading-tight focus:outline-none focus:border-[#0d6efd]"
                        name="keluhan"
                        required></textarea>
                </div>

                <!-- Submit Button -->
                <div class="w-full px-3 mb-6">
                    <button type="submit"
                        class="appearance-none block w-full bg-blue-700 hover:bg-blue-800 text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Daftar
                    </button>
                </div>
            </form>
        </div>

        <!-- HISTORY TABLE -->
        <div class="bg-white shadow-lg text-lg rounded-sm border border-gray-200">
            <div class="overflow-x-auto rounded-lg p-3">
                <table class="table-auto w-full">
                    <thead class="text-sm font-semibold uppercase text-gray-800 bg-gray-50">
                        <tr>
                            <th class="p-2">
                                <div class="font-semibold text-center">No.</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-left">Poli</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">Dokter</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">Jadwal</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">No. Antrian</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">Status</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @forelse($user->pasien->daftarPoli ?? [] as $appointment)
                        <tr>
                            <td class="p-2 text-center">{{ $loop->iteration }}</td>
                            <td class="p-2">{{ $appointment->dokter->poli->name ?? '-' }}</td>
                            <td class="p-2 text-center">{{ $appointment->dokter->name ?? '-' }}</td>
                            <td class="p-2 text-center">
                                {{ \Carbon\Carbon::parse($appointment->schedule->date ?? now())->format('l, d F Y') }}
                            </td>
                            <td class="p-2 text-center">{{ $appointment->no_antrian }}</td>
                            <td class="p-2 text-center">
                                <x-status-badge :status="$appointment->status ?? 'unknown'" />
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-2 text-center text-gray-500">
                                Belum ada pendaftaran poli
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const dokterSelect = document.getElementById('dokter_id');
        const scheduleSelect = document.getElementById('schedule_id');

        // Create hidden input for queue number if it doesn't exist
        let queueNumberInput = document.querySelector('input[name="no_antrian"]');
        if (!queueNumberInput) {
            queueNumberInput = document.createElement('input');
            queueNumberInput.type = 'hidden';
            queueNumberInput.name = 'no_antrian';
            form.appendChild(queueNumberInput);
        }

        // Filter schedules based on selected doctor
        dokterSelect.addEventListener('change', function() {
            const selectedDokterId = this.value;
            scheduleSelect.value = '';
            queueNumberInput.value = '';

            // Reset queue number preview
            const queuePreview = document.getElementById('queue-preview');
            if (queuePreview) {
                queuePreview.textContent = '';
            }

            Array.from(scheduleSelect.options).forEach(option => {
                if (option.value === '') return;
                const dokterIdForSchedule = option.getAttribute('data-dokter');
                option.style.display = dokterIdForSchedule === selectedDokterId ? '' : 'none';
            });

            scheduleSelect.disabled = false;
        });

        // Fetch queue number when schedule is selected
        scheduleSelect.addEventListener('change', async function() {
            const selectedScheduleId = this.value;
            const selectedDokterId = dokterSelect.value;

            if (selectedScheduleId && selectedDokterId) {
                try {
                    const response = await fetch(`/api/queue-number?schedule_id=${selectedScheduleId}&dokter_id=${selectedDokterId}`);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    const data = await response.json();

                    // Set the queue number in hidden input
                    queueNumberInput.value = data.queueNumber;

                    // Show queue number preview
                    const queuePreview = document.getElementById('queue-preview');
                    if (queuePreview) {
                        queuePreview.textContent = `Nomor Antrian Anda: ${data.queueNumber}`;
                    }

                    console.log('Queue number set:', data.queueNumber);
                } catch (error) {
                    console.error('Error fetching queue number:', error);
                    alert('Gagal mengambil nomor antrian. Silakan coba lagi.');
                }
            }
        });

        scheduleSelect.disabled = !dokterSelect.value;
    });
</script>


@endsection