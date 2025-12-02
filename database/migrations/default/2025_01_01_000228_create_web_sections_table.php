<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('web_sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('web_id')->constrained('webs')->cascadeOnDelete();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('uuid');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('web_sections');
    }
};
