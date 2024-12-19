@extends('layouts.pasien')

@section('title', 'Manage Poli')

@section('content')
<main>
    <div class="container px-4 py-12 mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Selamat Datang di Poli</h1>
            <p class="text-gray-600 text-lg">Pilih Poli sesuai dengan keluhan anda</p>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($polis as $poli)
            <a href="{{ route('pasien.poli.show', ['poli' => $poli->id]) }}" class="block">
                <div class="poli-card" onclick="showToast('General Medicine')">
                    <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 hover:-translate-y-1">
                        <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-hospital text-purple-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 text-center mb-2">{{ $poli->name }}</h3>
                        <p class="text-gray-600 text-center text-sm">Primary healthcare services</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
</main>
@endsection