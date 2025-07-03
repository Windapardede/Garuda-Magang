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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('posisi_id');
            $table->integer('instansi_id');
            $table->integer('jurusan_id');
            $table->integer('role_id');
            $table->integer('mentor_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('nim');
            $table->string('religion');
            $table->tinyInteger('is_active');
            // $table->enum('role', ['admin', 'mentor', 'hrd', 'user']);
            $table->enum('status', ['lulus', 'tes_kemampuan', 'ditolak', 'administrasi', 'wawancara', 'diterima']);
            $table->string('gender');
            // $table->string('phone');
            $table->string('surat');
            $table->string('cv');
            $table->text('image');
            $table->timestamps();
        });


        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
