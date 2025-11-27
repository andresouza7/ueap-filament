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
        Schema::create('web_banners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('web_banner_place_id')->constrained('web_banner_places')->cascadeOnDelete();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('url');
            $table->string('status');
            $table->integer('hits')->default(0)->nullable();
            $table->foreignId('user_created_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('user_updated_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('old_file')->nullable();
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
        Schema::dropIfExists('web_banners');
    }
};
