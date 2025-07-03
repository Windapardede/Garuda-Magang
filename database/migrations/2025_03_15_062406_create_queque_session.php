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
        Schema::create('queque_session', function (Blueprint $table) {
            $table->id();
            $table->boolean('status');
            $table->date('date');
            $table->integer('details_rent_playstation_id');
            $table->string('note');

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
        Schema::dropIfExists('queque_session');
    }
};
