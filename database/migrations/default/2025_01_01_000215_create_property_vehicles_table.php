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
        Schema::create('property_vehicles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('plate');
            $table->string('brand');
            $table->string('description');
            $table->string('observation')->nullable();
            $table->timestamps(); // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_vehicles');
    }
};
