@extends('layouts.admin')

@section('title', 'Manage Pasien')

@section('content')
<main>
    <div class="grid grid-cols-1 gap-4 px-4 mt-8 sm:grid-cols-4 sm:px-8">
        <div class="container mx-auto">
            <h1 class="text-xl font-bold mb-4">Daftar Pasien</h1>
        </div>
        <div class="container mx-auto">

        </div>
        <div class="container mx-auto">

        </div>
        <div class="container mx-auto flex items-center">
            <span class="px-5">
                <a href="{{ route('poli.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah Periksa</a>
            </span>
        </div>
    </div>
    <!-- TABEL POLI -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-blue-100 dark:text-blue-100">
            <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Pasien
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Dokter
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Poli
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jadwal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($polis as $poli)
                <tr class="bg-blue-500 border-b border-blue-400">
                    <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                        {{ $loop->iteration }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $poli->pasien->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $poli->dokter->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $poli->poli }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $poli->schedule->start_time }} - {{ $poli->schedule->end_time }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $poli->status }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('poli.edit', $poli->id) }}" class="text-blue-700 bg-white hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:text-blue-700 dark:hover:text-white dark:hover:bg-blue-700 dark:focus:text-white">Edit</a>
                        <form action="{{ route('poli.destroy', $poli->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-blue-700 bg-white hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:text-blue-700 dark:hover:text-white dark:hover:bg-blue-700 dark:focus:text-white">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
@endsection