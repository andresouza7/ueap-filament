<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_ordinance_person', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')
                ->constrained('persons')
                ->cascadeOnDelete();

            $table->foreignId('document_ordinance_id')
                ->constrained('document_ordinances')
                ->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();
            $table->string('_delete_')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_ordinance_person');
    }
};
