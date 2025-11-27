<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('web_posts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('web_category_id')
                ->constrained('web_categories')
                ->cascadeOnDelete();

            $table->string('slug')->nullable();
            $table->string('title');
            $table->string('resume')->nullable();
            $table->text('text');
            $table->string('text_credits')->nullable();
            $table->string('image_credits')->nullable();
            $table->string('image_subtitle')->nullable();

            $table->boolean('featured')->default(false);
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
        Schema::dropIfExists('web_posts');
    }
};
