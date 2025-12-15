<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consu_resolutions', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->integer('number');
            $table->integer('year');
            $table->text('name');
            $table->string('description')->nullable();
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

            $table->string('old_file')->nullable();
            $table->string('_del_')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consu_resolutions');
    }
};
