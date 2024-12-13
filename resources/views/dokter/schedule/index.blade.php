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
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Status</th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">1</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">Mark</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">Otto</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">@mdo</td>
                </tr>
                <tr class="bg-white border-b">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">2</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">Jacob</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">Thornton</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">@fat</td>
                </tr>
                <tr class="bg-white border-b">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">3</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">Larry</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">Wild</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>


@endsection