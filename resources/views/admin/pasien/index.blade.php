@extends('layouts.admin')

@section('title', 'Manage Pasien')

@section('content')
<main>
    <!-- Stats and Action Bar -->
    <div class="grid grid-cols-1 gap-4 px-4 mb-8 sm:grid-cols-4 sm:px-8">
        <div class="p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
            <h2 class="text-gray-500 text-sm font-semibold">Total Pasien</h2>
            <p class="text-3xl font-bold text-blue-600">{{ $pasiens->count() }}</p>
        </div>
        <div class="p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
            <h2 class="text-gray-500 text-sm font-semibold">Pasien Baru Bulan Ini</h2>
            <p class="text-3xl font-bold text-green-600">{{ $pasiens->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
        </div>
        <div class="p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
            <h2 class="text-gray-500 text-sm font-semibold">Pasien Aktif</h2>
            <p class="text-3xl font-bold text-purple-600">{{ $pasiens->where('status', 'active')->count() }}</p>
        </div>
        <div class="p-6 items-center justify-between">
            <a href="{{ route('admin.pasien.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm transition-colors duration-200 ease-in-out transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Pasien
            </a>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="px-4 sm:px-8 mb-6">
        <div class="relative">
            <input type="text" id="searchInput" class="w-full p-4 pl-10 text-sm text-gray-900 border border-gray-200 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500" placeholder="Cari pasien...">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Patient Table -->
    <div class="px-4 sm:px-8">
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                            <th class="px-6 py-4 font-semibold">Nomor Rekam Medis</th>
                            <th class="px-6 py-4 font-semibold">Nama</th>
                            <th class="px-6 py-4 font-semibold">No.Telp</th>
                            <th class="px-6 py-4 font-semibold">Alamat</th>
                            <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="patientTableBody">
                        @foreach ($pasiens as $pasien)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium">{{ $pasien->medical_record_number }}</td>
                            <td class="px-6 py-4">{{ $pasien->name }}</td>
                            <td class="px-6 py-4">{{ $pasien->phone }}</td>
                            <td class="px-6 py-4">{{ $pasien->address }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.pasien.edit', $pasien->id) }}"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.pasien.destroy', $pasien->id) }}" method="POST" class="inline-block delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('#patientTableBody tr');

        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();

            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        // Delete confirmation
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('Apakah Anda yakin ingin menghapus pasien ini?')) {
                    this.submit();
                }
            });
        });
    });
</script>
@endsection