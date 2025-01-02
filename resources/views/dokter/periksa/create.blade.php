@extends('layouts.dokter')

@section('title', 'Periksa')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            {{-- Page Header --}}
            <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700">
                <h1 class="text-2xl font-bold text-white">Periksa {{ $daftarPoli->pasien->name }}</h1>
            </div>

            {{-- Main Form --}}
            <div class="p-6">
                <form action="{{ route('dokter.periksa.store', $daftarPoli->id) }}" method="POST" id="periksaForm">
                    @csrf

                    <!-- Patient Info Card -->
                    <div class="mb-6 bg-blue-50 rounded-lg p-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" xmlns="http:
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

                    {{-- Examination Details --}}
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        {{-- Examination Date Field --}}
                        <div>
                            <label for="tgl_periksa" class="block text-sm font-medium text-gray-700">
                                Tanggal Periksa
                            </label>
                            <input type="date"
                                id="tgl_periksa"
                                name="tgl_periksa"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        {{-- Base Examination Fee Field --}}
                        <div>
                            <label for="biaya_periksa" class="block text-sm font-medium text-gray-700">
                                Biaya Periksa (Base)
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                </div>
                                <input type="number"
                                    id="biaya_periksa"
                                    name="biaya_periksa"
                                    class="block w-full pl-12 pr-12 border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                    value="{{ old('biaya_periksa', 150000) }}"
                                    readonly>
                            </div>
                        </div>
                    </div>

                    {{-- Medicine Selection Section --}}
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Obat yang Diberikan</h3>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            {{-- Selected Medicines Display --}}
                            <div id="selectedObatTags" class="flex flex-wrap gap-2 mb-4">
                                {{-- Pills will be added here --}}
                            </div>

                            {{-- Medicine Search Input --}}
                            <div class="relative">
                                <input type="text"
                                    id="obatSearch"
                                    class="block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Ketik untuk mencari obat...">

                                {{-- Medicine Suggestions Dropdown --}}
                                <ul id="obatSuggestions"
                                    class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg max-h-40 overflow-auto hidden">
                                </ul>
                            </div>

                            {{-- Hidden inputs for selected medicines --}}
                            <div id="selectedObatsContainer">
                                <input type="hidden" name="selected_obats" id="selectedObatsInput" value="[]">
                            </div>
                        </div>
                    </div>


                    {{-- Notes Section --}}
                    <div class="mt-6">
                        <label for="catatan" class="block text-sm font-medium text-gray-700">
                            Catatan Pemeriksaan
                        </label>
                        <textarea id="catatan"
                            name="catatan"
                            rows="4"
                            class="mt-1 shadow-sm block w-full focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md"
                            placeholder="Tambah catatan pemeriksaan di sini"></textarea>
                    </div>

                    {{-- Total Cost Field --}}
                    <div>
                        <label for="total_biaya" class="block text-sm font-medium text-gray-700">Total Biaya</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input
                                type="number"
                                id="total_biaya"
                                name="total_biaya"
                                class="block w-full pl-12 pr-12 border-gray-300 bg-blue-50 font-semibold rounded-md focus:ring-blue-500 focus:border-blue-500"
                                value="150000"
                                readonly>
                        </div>
                    </div>

                    {{-- Form Actions --}}
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

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        const elements = {
            biayaPeriksa: document.getElementById("biaya_periksa"),
            totalBiaya: document.getElementById("total_biaya"),
            catatan: document.getElementById("catatan"),
            
            obatSearch: document.getElementById("obatSearch"),
            obatSuggestions: document.getElementById("obatSuggestions"),
            selectedObatsInput: document.getElementById("selectedObatsInput"),
            selectedObatTags: document.getElementById("selectedObatTags"),
        };

        
        const state = {
            selectedObats: new Map(),
            baseFee: 150000, 
            debounceTimer: null
        };

        
        function formatRupiah(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(amount);
        }

        
        function debounce(func, wait) {
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(state.debounceTimer);
                    func(...args);
                };
                clearTimeout(state.debounceTimer);
                state.debounceTimer = setTimeout(later, wait);
            };
        }

        function formatRupiah(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(amount);
        }

        
        async function fetchObatSuggestions(query) {
            try {
                const response = await fetch(`/api/obat/search?query=${query}`);
                if (!response.ok) throw new Error('Network response was not ok');
                return await response.json();
            } catch (error) {
                console.error("Error fetching obat suggestions:", error);
                return [];
            }
        }

        async function fetchObatPrice(obatId) {
            try {
                const response = await fetch(`/api/obat/harga/${obatId}`);
                if (!response.ok) throw new Error('Network response was not ok');
                const data = await response.json();
                return data.harga || 0;
            } catch (error) {
                console.error("Error fetching obat harga:", error);
                return 0;
            }
        }

        
        async function updateTotalBiaya() {
            let totalObat = 0;

            
            for (const [_, obat] of state.selectedObats) {
                totalObat += parseInt(obat.harga) || 0;
            }

            
            const total = state.baseFee + totalObat;

            
            elements.totalBiaya.value = total;

            
            elements.selectedObatsInput.value = JSON.stringify(
                Array.from(state.selectedObats.values())
                    .map(obat => ({
                        id: obat.id,
                        nama: obat.nama,
                        harga: obat.harga
                    }))
            );
        }




        
        function createObatTag(obat) {
            const pill = document.createElement("div");
            pill.className = "flex items-center space-x-2 bg-blue-100 text-blue-700 px-3 py-1 rounded-full";
            pill.innerHTML = `
                <span>${obat.nama} (${formatRupiah(obat.harga)})</span>
                <button type="button" class="text-red-500 hover:text-red-700" data-id="${obat.id}">×</button>
            `;

            pill.querySelector("button").addEventListener("click", () => removeSelectedObat(obat.id));
            return pill;
        }

        function displayObatSuggestions(obats) {
            elements.obatSuggestions.innerHTML = "";

            if (obats.length === 0) {
                const li = document.createElement("li");
                li.textContent = "Tidak ada obat ditemukan";
                li.className = "px-4 py-2 text-gray-500 italic";
                elements.obatSuggestions.appendChild(li);
            } else {
                obats.forEach(obat => {
                    if (!state.selectedObats.has(obat.id)) {
                        const li = document.createElement("li");
                        li.textContent = `${obat.nama} (${obat.kemasan})`;
                        li.className = "cursor-pointer px-4 py-2 hover:bg-gray-100";
                        li.addEventListener("click", () => handleObatSelection(obat));
                        elements.obatSuggestions.appendChild(li);
                    }
                });
            }

            elements.obatSuggestions.classList.remove("hidden");
        }

        
        const handleObatSearch = debounce(async (event) => {
            const query = event.target.value.trim();

            if (query.length < 2) {
                elements.obatSuggestions.classList.add("hidden");
                return;
            }

            const obats = await fetchObatSuggestions(query);
            displayObatSuggestions(obats);
        }, 300);

        async function handleObatSelection(obat) {
            if (!state.selectedObats.has(obat.id)) {
                const harga = await fetchObatPrice(obat.id);
                obat.harga = harga;

                state.selectedObats.set(obat.id, obat);
                elements.selectedObatTags.appendChild(createObatTag(obat));
                updateTotalBiaya();
            }

            elements.obatSearch.value = "";
            elements.obatSuggestions.classList.add("hidden");
        }

        function removeSelectedObat(obatId) {
            const pill = elements.selectedObatTags.querySelector(`button[data-id="${obatId}"]`).parentElement;
            if (pill) {
                elements.selectedObatTags.removeChild(pill);
                state.selectedObats.delete(obatId);
                updateTotalBiaya();
            }
        }

        
        elements.obatSearch.addEventListener("input", handleObatSearch);

        document.addEventListener("click", (event) => {
            if (!elements.obatSearch.contains(event.target) && !elements.obatSuggestions.contains(event.target)) {
                elements.obatSuggestions.classList.add("hidden");
            }
        });

        
        const today = new Date().toISOString().split('T')[0];
        document.getElementById("tgl_periksa").value = today;
    });
</script>
@endpush
@endsection