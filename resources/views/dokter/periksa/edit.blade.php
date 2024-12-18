@extends('layouts.dokter')

@section('title', 'Edit Periksa')

@section('content')
<div class="container">
    <h1>Edit Periksa</h1>

    <form action="{{ route('dokter.periksa.update', $periksa->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="pasien" class="form-label">Pasien</label>
            <input type="text" id="pasien" class="form-control" value="{{ $periksa->pasien->name }}" disabled>
        </div>

        <div class="mb-3">
            <label for="schedule" class="form-label">Jadwal Periksa</label>
            <input type="text" id="schedule" class="form-control" value="{{ $periksa->schedule->time ?? 'N/A' }}" disabled>
        </div>

        <div class="mb-3">
            <label for="keluhan" class="form-label">Keluhan</label>
            <textarea id="keluhan" name="keluhan" class="form-control" rows="4">{{ $periksa->keluhan }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select">
                <option value="menunggu" {{ $periksa->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="dalam_antrian" {{ $periksa->status == 'dalam_antrian' ? 'selected' : '' }}>Dalam Antrian</option>
                <option value="selesai" {{ $periksa->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('dokter.periksa.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
