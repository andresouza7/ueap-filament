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
        Schema::create('web_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('web_menu_place_id')->constrained('web_menu_places')->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('status');
            $table->integer('position');
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
        Schema::dropIfExists('web_menus');
    }
};
