<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('web_pages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('web_category_id')
                ->nullable()
                ->constrained('web_categories')
                ->cascadeOnDelete();

            $table->foreignId('web_menu_id')
                ->nullable()
                ->constrained('web_menus')
                ->cascadeOnDelete();

            $table->string('slug')->unique();
            $table->string('title');
            $table->string('description')->nullable();
            $table->text('text');
            $table->string('status');
            $table->integer('hits')->default(0);

            $table->foreignId('user_created_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('user_updated_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();
            $table->uuid('uuid');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('web_pages');
    }
};
