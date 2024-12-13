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
        Schema::create('daftar_poli', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dokter_id')->nullable()->constrained('dokters')->onDelete('set null');
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('schedule_id')->nullable()->constrained('schedules')->onDelete('set null');
            $table->integer('no_antrian')->nullable();
            $table->text('keluhan')->nullable();
            $table->enum('status', ['selesai', 'dalam_antrian', 'menunggu'])->default('menunggu'); // Add status column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('daftar_poli', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
