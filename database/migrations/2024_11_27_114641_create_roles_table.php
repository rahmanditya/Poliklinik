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
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('role_name', 255);
            $table->string('role_code', 255)->unique();
            $table->foreignId('role_group_id')->nullable(true)->constrained('role_groups');
            $table->text('description')->nullable(true);
            $table->enum('active', ["Y", "N"])->nullable(true)->default("Y");
            $table->timestampsTz($precision = 0);
        });

        DB::table("roles")->insert([
            "id" => 1,
            "role_code" => "admin",
            "role_name" => "Admin",
            "description" => "Admin"
        ]);
        DB::table("roles")->insert([
            "id" => 2,
            "role_code" => "dokter",
            "role_name" => "Dokter",
            "description" => "Dokter"
        ]);
        DB::table("roles")->insert([
            "id" => 3,
            "role_code" => "pasien",
            "role_name" => "Pasien",
            "description" => "Pasien"
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
