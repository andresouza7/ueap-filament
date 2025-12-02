<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consu_calendars', function (Blueprint $table) {
            $table->id(); // BIGINT + PK
            $table->uuid('uuid')->unique();
            $table->string('title');
            $table->string('description')->nullable();
            $table->timestamp('date_time');
            $table->integer('hits');

            $table->foreignId('user_created_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('user_updated_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consu_calendars');
    }
};
