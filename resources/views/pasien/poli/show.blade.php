@extends('layouts.pasien')

@section('title', 'Dafatar Poli')

@section('content')
<main>
    <div class="header my-3 h-12 px-10 flex items-center justify-between">
        <h1 class="font-medium text-2xl">Daftar Poli</h1>
    </div>
    <div class="flex flex-col mx-3 mt-6 lg:flex-row">
        <div class="w-full lg:w-1/3 m-1">
            <form class="w-full bg-white shadow-md p-6">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-full px-3 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2" htmlFor="medical_record_number">Nomor Rekam Medis</label>
                        <input type="text" name="medical_record_number" id="medical_record_number"
                            value="{{ $medical_record_number }}"
                            class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer cursor-not-allowed"
                            disabled readonly placeholder=" " />
                    </div>

                    <div class="w-full md:w-full px-3 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2" htmlFor="dokter">Pilih Dokter di Poli {{ $poli->name }}</label>
                        <select name="dokter_id" id="dokter_id" required class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                            <option value="" disabled selected>Pilih Dokter</option>
                            @foreach ($dokters as $dokter)
                            <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full md:w-full px-3 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2" htmlFor="shcedule">Pilih Jadwal</label>
                        <select name="schedule_id" id="schedule_id" required class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                            <option value="" disabled selected>Pilih Jadwal</option>
                            @foreach ($schedules as $schedule)
                            <option value="{{ $schedule->id }}">{{ $schedule->date }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full px-3 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2" htmlFor="keluhan">Keluhan</label>
                        <textarea textarea rows="4" class="appearance-none block w-full bg-white text-gray-900 font-medium border border-gray-400 rounded-lg py-3 px-3 leading-tight focus:outline-none focus:border-[#0d6efd]" type="text" name="description" required> </textarea>
                    </div>

                    <div class="w-full md:w-full px-3 mb-6">
                        <button class="appearance-none block w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Daftar</button>
                    </div>

                    <!-- <div class="w-full px-3 mb-8">
                        <label class="mx-auto cursor-pointer flex w-full max-w-lg flex-col items-center justify-center rounded-xl border-2 border-dashed border-green-400 bg-white p-6 text-center" htmlFor="dropzone-file">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>

                            <h2 class="mt-4 text-xl font-medium text-gray-700 tracking-wide">Category image</h2>

                            <p class="mt-2 text-gray-500 tracking-wide">Upload or drag & drop your file SVG, PNG, JPG or GIF. </p>

                            <input id="dropzone-file" type="file" class="hidden" name="category_image" accept="image/png, image/jpeg, image/webp" />
                        </label>
                    </div> -->

                </div>
            </form>
        </div>
        <div class="w-full lg:w-2/3 m-1 bg-white shadow-lg text-lg rounded-sm border border-gray-200">
            <div class="overflow-x-auto rounded-lg p-3">
                <table class="table-auto w-full">
                    <thead class="text-sm font-semibold uppercase text-gray-800 bg-gray-50 mx-auto">
                        <tr>
                            <!-- <th></th> -->
                            <!-- <th><svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 h-5 mx-auto">
                                    <path d="M6 22h12a2 2 0 0 0 2-2V8l-6-6H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2zm7-18 5 5h-5V4zm-4.5 7a1.5 1.5 0 1 1-.001 3.001A1.5 1.5 0 0 1 8.5 11zm.5 5 1.597 1.363L13 13l4 6H7l2-3z"></path>
                                </svg></th> -->
                            <th class="p-1">
                                <div class="font-semibold">No.</div>
                            </th>
                            <th class="p-1">
                                <div class="font-semibold text-left">Poli</div>
                            </th>
                            <th class="p-1">
                                <div class="font-semibold text-center">Dokter</div>
                            </th>
                            <th class="p-1">
                                <div class="font-semibold">Hari</div>
                            </th>
                            <th class="p-1">
                                <div class="font-semibold text-center">Aksi</div>
                            </th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Bedah</td>                
                            <td>Dr Imron</td>
                            <td>Selasa</td>
                            <td class="p-2">
                                <div class="flex justify-center">
                                    <a href="#" class="rounded-md hover:bg-green-100 text-green-600 p-2 flex justify-between items-center">
                                        <span>
                                            <FaEdit class="w-4 h-4 mr-1" />
                                        </span> Edit
                                    </a>
                                    <button class="rounded-md hover:bg-red-100 text-red-600 p-2 flex justify-between items-center">
                                        <span>
                                            <FaTrash class="w-4 h-4 mr-1" />
                                        </span> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        
    </div>
</main>


@endsection