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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('type'); // e.g. 'consu_resolution', 'orcamento', 'portaria', etc.
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->year('year')->nullable();
            $table->string('status')->nullable();

            // All special fields go here
            $table->jsonb('metadata')->nullable();

            $table->unsignedBigInteger('user_created_id')->nullable();
            $table->unsignedBigInteger('user_updated_id')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
