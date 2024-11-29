@extends('layouts.app')

@section('title', 'Poliklinik')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poliklinik Udinus</title>
    @vite('resources/css/app.css') 
</head>

<body>
<div class="min-vh-100 d-flex flex-column justify-content-center align-items-center bg-light">

    <!-- Login Cards -->
    <div class="row justify-content-center w-100">

        <!-- Patient Login -->
        <div class="col-12 col-md-4">
            <div class="index-card relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
                <div
                    class="group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:mx-auto sm:max-w-sm sm:rounded-lg sm:px-10">
                    <span class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-hover:scale-[10]"></span>
                    <div class="relative z-10 mx-auto max-w-md">
                        <span class="grid h-20 w-20 place-items-center rounded-full bg-sky-500 transition-all duration-300 group-hover:bg-sky-400">
                            <svg 
                            xmlns="http://www.w3.org/2000/svg" 
                            viewBox="0 0 512 444.97" 
                            width="24" 
                            height="24" 
                            stroke-width="1.5" 
                            stroke="currentColor" 
                            class="h-10 w-10 text-white transition-all" 
                            fill="white"
                            >
                            <path stroke-linecap="round" stroke-linejoin="round" d="m235.51 272.75 58.39 40.17 58.38-40.17H235.51zM52.37 0C76.46 0 96 19.53 96 43.63S76.46 87.26 52.37 87.26c-24.1 0-43.63-19.53-43.63-43.63S28.27 0 52.37 0zm68.08 150.67c-22.5-10.3-10.79-48.78 16.95-29.41l55.51 38.79 85.75 1.73c9.18.07 16.56 7.57 16.49 16.75-.07 9.18-7.57 16.56-16.75 16.49l-86.51-1.74c-1.67.13-3.39 0-5.11-.41l-66.33-42.2zm338.7 36.7c30.23 3.83 42-45.64 6.08-52.64l-230.46-6.75c-29.08-2.89-58.7-64.08-113.79-61.52-33.9 1.58-46.21 34.57-20.08 65.67.04-4.33 1.07-8.57 2.97-12.19l.26-.46c2.05-3.69 5.02-6.78 8.81-8.81 7.37-3.94 17.38-3.75 28.87 4.28l53.59 37.44 83.48 1.69a24.24 24.24 0 0 1 16.99 7.25 24.276 24.276 0 0 1 6.98 17.26c-.03 3.89-.97 7.56-2.62 10.81l25.71-1.39 133.21-.64zM1.08 134.93l127.49 103.23c2.29 2.3 2.91 2.36 6.12 2.36h374.48c1.56 0 2.83-1.27 2.83-2.82v-26.13c0-1.55-1.33-2.83-2.83-2.83H151.19c-.34 0-.7.07-1.03.19L29.35 106.66c-1.48-1.26-3.65-1.37-5.02 0L1.08 129.91c-1.37 1.37-1.51 3.8 0 5.02zm391.96 244.71c18.04 0 32.66 14.63 32.66 32.67s-14.62 32.66-32.66 32.66-32.67-14.62-32.67-32.66c0-9.59 4.13-18.23 10.72-24.2l-77.2-53.18-71.86 49.51c9.37 5.74 15.62 16.07 15.62 27.87 0 18.04-14.62 32.66-32.66 32.66s-32.67-14.62-32.67-32.66c0-14.34 9.24-26.52 22.09-30.91l.3-.23 83.21-57.25-74.25-51.17h-87.73c-1.96 0-3.61-1.62-3.61-3.6v-10.99c0-1.99 1.63-3.61 3.61-3.61h385.74c1.98 0 3.61 1.65 3.61 3.61v10.99c0 1.96-1.65 3.6-3.61 3.6H384.12l-74.25 51.17 81.09 55.79c.69-.04 1.38-.07 2.08-.07zm0 21.12c6.37 0 11.54 5.17 11.54 11.55 0 6.37-5.17 11.54-11.54 11.54-6.38 0-11.55-5.17-11.55-11.54 0-6.38 5.17-11.55 11.55-11.55zm-188.05 0c6.37 0 11.54 5.17 11.54 11.55 0 6.37-5.17 11.54-11.54 11.54-6.38 0-11.55-5.17-11.55-11.54 0-6.38 5.17-11.55 11.55-11.55z" />
                            </svg>
                        </span>
                        <div
                            class="space-y-6 pt-5 text-base leading-7 text-gray-600 transition-all duration-300 group-hover:text-white/90">
                            <p>Di portal pasien, anda dapat melakukan pendaftaran ke poli dan menyesuaikan jadwal temu anda</p>
                        </div>
                        <div class="pt-5 text-base font-semibold leading-7">
                            <p>
                                <a href="/login?role=pasien&role_id=3" class="text-sky-500 transition-all duration-300 group-hover:text-white">Login sebagai pasien
                                    &rarr;
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Doctor Login -->
        <div class="col-12 col-md-4">
            <div class="index-card relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
                <div
                    class="group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:mx-auto sm:max-w-sm sm:rounded-lg sm:px-10">
                    <span class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-hover:scale-[10]"></span>
                    <div class="relative z-10 mx-auto max-w-md">
                        <span class="grid h-20 w-20 place-items-center rounded-full bg-sky-500 transition-all duration-300 group-hover:bg-sky-400">
                            <svg 
                            xmlns="http://www.w3.org/2000/svg" 
                            viewBox="-30 0 512 500.97" 
                            stroke="currentColor" 
                            width="64"
                            height="64"
                            class="h-10 w-10 text-white transition-all" 
                            fill="white"
                            >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zM104 424c0 13.3 10.7 24 24 24s24-10.7 24-24-10.7-24-24-24-24 10.7-24 24zm216-135.4v49c36.5 7.4 64 39.8 64 78.4v41.7c0 7.6-5.4 14.2-12.9 15.7l-32.2 6.4c-4.3 .9-8.5-1.9-9.4-6.3l-3.1-15.7c-.9-4.3 1.9-8.6 6.3-9.4l19.3-3.9V416c0-62.8-96-65.1-96 1.9v26.7l19.3 3.9c4.3 .9 7.1 5.1 6.3 9.4l-3.1 15.7c-.9 4.3-5.1 7.1-9.4 6.3l-31.2-4.2c-7.9-1.1-13.8-7.8-13.8-15.9V416c0-38.6 27.5-70.9 64-78.4v-45.2c-2.2 .7-4.4 1.1-6.6 1.9-18 6.3-37.3 9.8-57.4 9.8s-39.4-3.5-57.4-9.8c-7.4-2.6-14.9-4.2-22.6-5.2v81.6c23.1 6.9 40 28.1 40 53.4 0 30.9-25.1 56-56 56s-56-25.1-56-56c0-25.3 16.9-46.5 40-53.4v-80.4C48.5 301 0 355.8 0 422.4v44.8C0 491.9 20.1 512 44.8 512h358.4c24.7 0 44.8-20.1 44.8-44.8v-44.8c0-72-56.8-130.3-128-133.8z" />
                            </svg>
                        </span>
                        <div
                            class="space-y-6 pt-5 text-base leading-7 text-gray-600 transition-all duration-300 group-hover:text-white/90">
                            <p>Di portal dokter, anda dapat mengelola pasien</p>
                        </div>
                        <div class="pt-5 text-base font-semibold leading-7">
                            <p>
                                <a href="/login?role=dokter&role_id=2" class="text-sky-500 transition-all duration-300 group-hover:text-white">Login sebagai dokter
                                    &rarr;
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
