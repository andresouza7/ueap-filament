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
        Schema::create('property_furnitures', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('number');
            $table->string('name');
            $table->string('object');
            $table->string('sector');
            $table->string('observation')->nullable();
            $table->timestamps(); // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_furnitures');
    }
};
