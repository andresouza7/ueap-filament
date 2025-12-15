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
        Schema::create('web_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('web_section_id')->constrained('web_sections')->cascadeOnDelete();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('slug')->unique();
            $table->uuid('uuid');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_categories');
    }
};
