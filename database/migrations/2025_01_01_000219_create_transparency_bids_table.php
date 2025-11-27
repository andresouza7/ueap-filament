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
        Schema::create('transparency_bids', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('type');
            $table->string('number')->nullable();
            $table->string('year')->nullable();
            $table->string('location')->nullable();
            $table->string('link')->nullable();
            $table->text('description');
            $table->text('observation');
            $table->timestamp('start_date');
            $table->integer('hits')->default(0);
            $table->string('status');
            $table->foreignId('user_created_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('user_updated_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('end_date')->nullable();
            $table->string('person_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transparency_bids');
    }
};
