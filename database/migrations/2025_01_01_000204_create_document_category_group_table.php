<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_category_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_category_id')
                ->constrained('document_categories')
                ->cascadeOnDelete();

            $table->foreignId('group_id')
                ->constrained('groups')
                ->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_category_group');
    }
};
