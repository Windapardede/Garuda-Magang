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
        Schema::create('details_session', function (Blueprint $table) {
            $table->id();
            // $table->timestamps();
            $table->string('name_playstation');
            $table->string('note');
            $table->integer('rent_session_id');

            // User tracking fields
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            // Explicit timestamps (created_at, updated_at)
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            // Soft delete
            $table->timestamp('deleted_at')->nullable(); // 'deleted_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details_session');
    }
};
