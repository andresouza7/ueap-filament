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
        Schema::create('user_task_subs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('user_task_id')->constrained('user_tasks')->cascadeOnDelete();
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('complete')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_task_subs');
    }
};
