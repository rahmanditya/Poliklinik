<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->text('password')->nullable();
            $table->foreignId('role_id')->constrained('roles');
            $table->timestampTz('email_verified_at')->nullable();
            $table->timestampTz('last_login_at')->nullable();
            $table->string('status_code')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestampsTz($precision = 0);
        });

        $role = DB::selectOne("SELECT id FROM roles WHERE role_code = 'admin'");
        DB::table("users")->insert([
            "name" => "Admin",
            "email" => "admin@mail.com",
            "password" => bcrypt("123123123"),
            "role_id" => $role->id,
            "status_code" => 'user_active'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
