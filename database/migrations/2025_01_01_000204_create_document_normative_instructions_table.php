<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_normative_instructions', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('number')->nullable();
            $table->string('year')->nullable();
            $table->string('issuer')->nullable();
            $table->date('issuance_date');
            $table->text('description');
            $table->string('status');

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
        Schema::dropIfExists('document_normative_instructions');
    }
};
