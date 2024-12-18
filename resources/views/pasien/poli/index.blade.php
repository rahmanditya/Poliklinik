@extends('layouts.pasien')

@section('title', 'Manage Poli')

@section('content')
<main>
    <section class="text-gray-700 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -m-4 text-center">
                @foreach ($polis as $poli)
                <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                    <a href="{{ route('pasien.poli.show', ['poli' => $poli->id]) }}" class="block">
                        <div class="border-2 border-gray-600 pxd-4 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                            <p class="title-font font-medium text-2xl text-gray-900">{{ $poli->name }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection