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
        Schema::create('web_menu_itens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('web_menu_id')->constrained('web_menus')->cascadeOnDelete();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('url');
            $table->integer('menu_parent_id')->nullable();
            $table->integer('position');
            $table->uuid('uuid');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_menu_itens');
    }
};
