@extends('layouts.dokter')

@section('title', 'Periksa')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700">
                <h1 class="text-2xl font-bold text-white">Periksa {{ $daftarPoli->pasien->name }}</h1>
            </div>

            <!-- Form Content -->
            <div class="p-6">
                <form action="{{ route('dokter.periksa.store', $daftarPoli->id) }}" method="POST">
                    @csrf

                    <!-- Patient Info Card -->
                    <div class="mb-6 bg-blue-50 rounded-lg p-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                                <input type="text" value="{{ $daftarPoli->pasien->name }}" class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0" disabled>
                            </div>
                        </div>
                    </div>

                    <!-- Form Grid -->
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Examination Date -->
                        <div>
                            <label for="tgl_periksa" class="block text-sm font-medium text-gray-700">Tanggal Periksa</label>
                            <input type="date" id="tgl_periksa" name="tgl_periksa" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                required>
                        </div>

                        <!-- Examination Fee -->
                        <div>
                            <label for="biaya_periksa" class="block text-sm font-medium text-gray-700">Biaya Periksa</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                </div>
                                <input type="number" id="biaya_periksa" name="biaya_periksa" 
                                    class="block w-full pl-12 pr-12 border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                                    placeholder="0.00" step="0.01">
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="mt-6">
                        <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                        <div class="mt-1">
                            <textarea id="catatan" name="catatan" rows="4" 
                                class="shadow-sm block w-full focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md" 
                                placeholder="Tambah catatan ke pasien di sini"></textarea>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex items-center justify-end space-x-4">
                        <a href="{{ route('dokter.periksa.index') }}" 
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Batal
                        </a>
                        <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Periksa Pasien
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection