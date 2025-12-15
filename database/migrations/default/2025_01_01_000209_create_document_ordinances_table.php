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
        Schema::create('document_ordinances', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->integer('year');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->string('_delete_')->nullable();
            $table->string('subject')->nullable();
            $table->string('origin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_ordinances');
    }
};
