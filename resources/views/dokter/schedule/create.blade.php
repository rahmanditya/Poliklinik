@extends('layouts.dokter')

@section('title', 'Buat Jadwal')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700">
                <h1 class="text-2xl font-bold text-white">Buat Jadwal</h1>
            </div>

            <!-- Form Content -->
            <div class="p-6">
                @if ($errors->any())
                <div class="mb-4 bg-red-50 border-l-4 border-red-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <form action="{{ route('dokter.schedule.store') }}" method="POST">
                    @csrf

                    <!-- Day Selection -->
                    <div class="mb-6">
                        <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
                        <select id="hari" name="hari" required
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-md">
                            <option value="">Pilih Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>



                    <!-- Time Range -->
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                            <input type="time" id="start_time" name="start_time" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                            <input type="time" id="end_time" name="end_time" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Status Toggle -->
                    <div class="mt-6">
                        <div class="flex items-center">
                            <button type="button" id="toggle-status"
                                class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 bg-gray-200"
                                role="switch"
                                aria-checked="false"
                                onclick="toggleStatus()">
                                <span class="sr-only">Schedule status</span>
                                <span id="toggle-button"
                                    class="pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200 translate-x-0">
                                </span>
                            </button>
                            <input type="hidden" name="is_active" id="is_active" value="0">
                            <span class="ml-3 text-sm font-medium text-gray-900" id="status-label">Tidak Aktif</span>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="mt-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700">Catatan</label>
                        <textarea id="notes" name="notes" rows="3"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Buat catatan ketika membuat jadwal..."></textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('dokter.schedule.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Buat Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleStatus() {
        const toggle = document.getElementById('toggle-status');
        const button = document.getElementById('toggle-button');
        const input = document.getElementById('is_active');
        const label = document.getElementById('status-label');

        const isActive = input.value === '1';

        if (!isActive) {
            toggle.classList.remove('bg-gray-200');
            toggle.classList.add('bg-blue-600');
            button.classList.add('translate-x-5');
            input.value = '1';
            label.textContent = 'Aktif';
        } else {
            toggle.classList.remove('bg-blue-600');
            toggle.classList.add('bg-gray-200');
            button.classList.remove('translate-x-5');
            input.value = '0';
            label.textContent = 'Tidak Aktif';
        }
    }
</script>
@endsection