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
        Schema::create('web_category_post', function (Blueprint $table) {
            $table->id();
            $table->foreignId('web_post_id')->constrained('web_posts')->onDelete('cascade');
            $table->foreignId('web_category_id')->constrained('web_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_category_post');
    }
};
