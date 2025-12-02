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
        Schema::create('transparency_bid_documents', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('transparency_bid_id')
                ->constrained('transparency_bids')
                ->cascadeOnDelete();
            $table->string('number')->nullable();
            $table->text('description');
            $table->integer('hits')->default(0);
            $table->foreignId('user_created_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('user_updated_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transparency_bid_documents');
    }
};
