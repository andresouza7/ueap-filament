<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calendar_occurrences', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->integer('type');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();

            // Campo "_delete_" original
            $table->string('_delete_')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calendar_occurrences');
    }
};
