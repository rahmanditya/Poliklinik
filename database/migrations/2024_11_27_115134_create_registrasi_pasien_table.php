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
        Schema::create('registrasi_pasien', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('pasien_id')->constrained('users'); 
            $table->foreignId('schedule_id')->constrained('schedules');
            $table->timestampsTz(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrasi_pasien');
    }
};
