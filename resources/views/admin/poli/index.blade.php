@extends('layouts.admin')

@section('title', 'Manage Poli')

@section('content')
<main>
    <!-- POLI  -->
    <section class="text-gray-700 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -m-4 text-center">
                @foreach ($polis as $poli)
                <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                    <div class="border-2 border-gray-600 px-4 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                        <a href="{{ route('admin.poli.show', ['poli' => $poli->id]) }}" class="poli-card block relative">
                            <p class="title-font font-medium text-2xl text-gray-900">{{ $poli->name }}</p>
                        </a>
                        <!-- Icons -->
                        <div class="absolute top-2 right-2 flex space-x-2">
                            <a href="{{ route('admin.poli.edit', $poli->id) }}" class="text-gray-600 hover:text-blue-600">
                                <i class="las la-edit"></i>
                            </a>

                            <a href="javascript:void(0);"
                                data-url="{{ route('admin.poli.destroy', ['poli' => $poli->id]) }}"
                                class="delete-icon text-gray-600 hover:text-red-600">
                                <i class="las la-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="flex justify-center mt-10">
                <a href="{{ route('admin.poli.create') }}"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-3 text-center flex items-center space-x-2">
                    <i class="las la-plus text-lg"></i>
                    <span>Tambah Poli</span>
                </a>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Attach click event to all delete icons
        document.querySelectorAll('.delete-icon').forEach(element => {
            element.addEventListener('click', () => {
                const url = element.getAttribute('data-url');
                if (confirm('Apakah anda yakin ingin menghapus poli ini?')) {
                    const form = document.createElement('form');
                    form.action = url;
                    form.method = 'POST';

                    // Add CSRF token
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';
                    form.appendChild(csrfInput);

                    // Add DELETE method override
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
</script>
@endsection