<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_generals', function (Blueprint $table) {
            $table->id(); // BIGINT + sequence
            $table->uuid('uuid')->unique();
            $table->string('type'); // FK para document_categories.slug
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('user_created_id');
            $table->unsignedBigInteger('user_updated_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('year')->nullable();
            $table->integer('year_end')->nullable();

            // Foreign keys
            $table->foreign('type')
                  ->references('slug')
                  ->on('document_categories')
                  ->cascadeOnDelete();

            $table->foreign('user_created_id')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();

            $table->foreign('user_updated_id')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_generals');
    }
};
