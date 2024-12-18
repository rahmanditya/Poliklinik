@extends('layouts.dokter')

@section('title', 'Manage Jadwal Periksa')

@section('content')

<main>
    <div class="grid grid-cols-1 gap-4 px-4 mt-8 sm:grid-cols-4 sm:px-8">
        <div class="container mx-auto">
            <h1 class="font-medium text-xl font-bold mb-4">Jadwal Periksa</h1>
        </div>
        <div class="container mx-auto">

        </div>
        <div class="container mx-auto">

        </div>
        <div class="container mx-auto flex items-center">
            <span class="px-5">
                <a href="{{ route('dokter.schedule.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah Jadwal</a>
            </span>
        </div>
    </div>

    <div class="flex flex-col mx-3 mt-6 lg:flex-row">

        <table class="min-w-full">
            <thead class="border-b">
                <tr>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">No</th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Nama Dokter</th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Hari</th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Jam Mulai</th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Jam Selesai</th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $key => $schedule)
                <tr class="border border-gray-300">
                    <td class="text-sm text-gray-900 px-6 py-4">{{ $key + 1 }}</td>
                    <td class="text-sm text-gray-900 px-6 py-4">
                        {{ $schedule->dokter->name ?? 'Dokter Tidak Ditemukan' }}
                    </td>
                    <td class="text-sm text-gray-900 px-6 py-4">{{ $schedule->hari }}</td>
                    <td class="text-sm text-gray-900 px-6 py-4">{{ $schedule->start_time }}</td>
                    <td class="text-sm text-gray-900 px-6 py-4">{{ $schedule->end_time }}</td>
                    <td class="text-sm text-gray-900 px-6 py-4">
                        <a href="#" class="text-blue-500 hover:underline">Edit</a> |
                        <a href="#" class="text-red-500 hover:underline">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>


@endsection