<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('periksa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daftar_poli_id')->constrained('daftar_poli')->onDelete('cascade'); // Tracks registration
            $table->foreignId('dokter_id')->nullable()->constrained('dokters')->onDelete('set null'); // Optional doctor
            $table->date('tgl_periksa');
            $table->text('catatan')->nullable(); 
            $table->decimal('biaya_periksa', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periksa');
    }
};
