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
        Schema::create('master_ps', function (Blueprint $table) {
            $table->id(); // auto-incrementing primary key
            $table->string('name'); // 'name' column (varchar)
            $table->double('price', 15, 2); // 'price' column (double with 2 decimal places)
            $table->double('additional_fee', 15, 2)->default(0)->nullable(); // 'additional_fee' column (double with 2 decimal places)

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

    public function down(): void
    {
        Schema::dropIfExists('master_ps');
    }
};
