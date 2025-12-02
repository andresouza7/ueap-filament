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
        Schema::create('transparency_orders', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('type');
            $table->integer('number')->nullable();
            $table->integer('month')->nullable();
            $table->integer('year');
            $table->string('category');
            $table->string('title');
            $table->string('description')->nullable();
            $table->integer('hits')->default(0);
            $table->foreignId('user_created_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('user_updated_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transparency_orders');
    }
};
