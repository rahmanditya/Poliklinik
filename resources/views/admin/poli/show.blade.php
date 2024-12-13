@extends('layouts.admin')

@section('title', 'Manage Dokter')

@section('content')
<main>
    <div class="grid-name grid grid-cols-1 gap-4 px-4 mt-8 sm:grid-cols-4 sm:px-4">
        <div class="container mx-auto">
            <h1 class="text-xl font-medium mb-4">Poli {{ $poli->name }}</h1>
        </div>

        <div class="container mx-auto">

        </div>
        <div class="container mx-auto">

        </div>
        <!-- route('poli.show', ['poli' => $poli->id]) -->

        <div class="container mx-auto flex items-center">

        </div>
    </div>

    <div class="grid-total-dokter grid grid-cols-3 gap-4 my-4">
        <div class="p-4 bg-blue-500 text-white rounded-lg">
            <h3 class="text-lg font-bold">Total Dokter</h3>
            <p>{{ $dokters->count() }}</p>
        </div>
        <div class="p-4 bg-green-500 text-white rounded-lg">
            <h3 class="text-lg font-bold">Pasien Terdaftar</h3>
            <p>{{ $pasiens->count() }}</p>
        </div>
    </div>

    <div class="grid-dokter">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-blue-100 dark:text-blue-100">
                <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Poli
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
                    @foreach ($dokters as $dokter)
                    <tr class="bg-blue-500 border-b border-blue-400">
                        <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                            {{ $dokter->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $dokter->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $dokter->specialization->name ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $dokter->status }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.dokter.edit', $dokter->id) }}" class="text-blue-700 bg-white hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:text-blue-700 dark:hover:text-white dark:hover:bg-blue-700 dark:focus:text-white">Edit</a>
                            <form action="{{ route('admin.dokter.destroy', $dokter->id) }}" method="POST" style="display:inline;">
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
    </div>

</main>


@endsection