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
        Schema::create('role_groups', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name', 255);
            $table->string('code', 255)->nullable(true)->unique();
            $table->enum('active', ["Y", "N"])->nullable(true)->default("Y");
            $table->text('description')->nullable(true);
            $table->timestampsTz($precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_groups');
    }
};
