@extends('layouts.pasien')

@section('title', 'Tambah Periksa')

@section('content')
<main>
    <div class="grid grid-cols-1 gap-4 px-4 mt-8 sm:grid-cols-4 sm:px-8">
        <h1 class="text-xl font-bold text-center col-span-4">Tambah Periksa untuk Poli {{ $poli->nama_poli }}</h1>
    </div>
    <div class="container mx-auto">
        <form action="{{ route('poli.storePeriksa', ['poli' => $poli->id]) }}" method="POST" class="max-w-md mx-auto">
            @csrf

            <!-- Select Patient -->
            <div class="relative z-0 w-full mb-5 group">
                <select name="pasien_id" id="pasien_id" required class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    <option value="" selected hidden>-- Pilih Pasien --</option>
                    @foreach ($pasiens as $pasien)
                    <option value="{{ $pasien->id }}">{{ $pasien->name }}</option>
                    @endforeach
                </select>
                <label for="pasien_id" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Pasien</label>
            </div>

            <!-- Select Doctor -->
            <div class="relative z-0 w-full mb-5 group">
                <select name="dokter_id" id="dokter_id" required class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    <option value="" selected hidden>-- Pilih Dokter --</option>
                    @foreach ($dokters as $dokter)
                    <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
                    @endforeach
                </select>
                <label for="dokter_id" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Dokter</label>
            </div>

            <!-- Appointment Date -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="date" name="appointment_date" id="appointment_date" required class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                <label for="appointment_date" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tanggal Periksa</label>
            </div>

            <!-- Complaint -->
            <div class="relative z-0 w-full mb-5 group">
                <textarea name="keluhan" id="keluhan" rows="4" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "></textarea>
                <label for="keluhan" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Keluhan</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Tambah Periksa
            </button>
        </form>
    </div>
</main>
@endsection