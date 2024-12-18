@if ($periksa->status === 'dalam_antrian')
<button data-modal-target="detailModal" data-modal-toggle="detailModal">
    Akhiri Periksa
</button>

<!-- Modal -->
<div id="detailModal" class="hidden">
    <div>
        <form action="{{ route('dokter.periksa.detail', $periksa->id) }}" method="POST">
            @csrf
            <textarea name="catatan" placeholder="Catatan Obat"></textarea>
            <input type="number" name="biaya_obat" placeholder="Biaya Obat">
            <button type="submit">Simpan</button>
        </form>
    </div>
</div>
@endif