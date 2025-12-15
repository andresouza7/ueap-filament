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
        Schema::create('user_records', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('user_uuid');
            $table->integer('ordinance')->nullable();
            $table->date('ordinance_date')->nullable();
            $table->date('admission_date')->nullable();
            $table->timestamps();
            $table->foreignId('level_id')
                ->nullable()
                ->constrained('progression_levels')
                ->nullOnDelete();
            $table->foreignId('class_id')
                ->nullable()
                ->constrained('progression_levels')
                ->nullOnDelete();
            $table->string('category')->nullable();
            $table->string('title')->nullable();
            $table->string('local')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_records');
    }
};
