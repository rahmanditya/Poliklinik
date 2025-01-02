@extends('layouts.dokter')

@section('title', 'Riwayat Periksa')

@section('content')
<main>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Riwayat Periksa</h1>
                </div>
                <div class="col-span-2"></div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Antrian</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pasien</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jadwal Periksa</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keluhan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detail Periksa</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($riwayatPeriksa as $periksa)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $periksa->no_antrian ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $periksa->pasien->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ ucfirst($periksa->schedule->hari) }} ({{ $periksa->schedule->start_time->format('H:i')}} - {{$periksa->schedule->end_time->format('H:i')}} )
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <div class="max-w-xs truncate">
                                    {{ $periksa->keluhan ?? 'Tidak ada keluhan' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ ucfirst($periksa->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <button onclick="openDetailModal('{{ $periksa->id }}')"
                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<div id="detailModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded shadow-lg w-1/3 p-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Detail Periksa</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div id="detailContent" class="mt-4">
            <!-- Content loaded dynamically -->
        </div>
    </div>
</div>

<script>
    function openDetailModal(periksaId) {
        const modal = document.getElementById('detailModal');
        const detailContent = document.getElementById('detailContent');

        modal.classList.remove('hidden');
        detailContent.innerHTML = '<div class="text-center">Loading...</div>';

        fetch(`/dokter/riwayat/${periksaId}/detail`)
            .then(response => response.json())
            .then(data => {
                detailContent.innerHTML = `
                <div>
                    <h4 class="text-md font-bold text-gray-700 mb-2">Obat yang Diresepkan:</h4>
                    <ul class="list-disc list-inside">
                        ${data.obats.map(obat => `<li>${obat.nama} (${obat.kemasan})</li>`).join('')}
                    </ul>
                </div>
                <div class="mt-4">
                    <a href="/dokter/riwayat/${periksaId}/edit" 
                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-200">
                        Edit Detail
                    </a>
                </div>
            `;
            })
            .catch(error => {
                detailContent.innerHTML = '<div class="text-center text-red-500">Error loading data</div>';
            });
    }


    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }
</script>

@endsection