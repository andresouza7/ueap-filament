<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_normative_instruction_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('document_normative_instruction_id')
                ->constrained('document_normative_instructions')
                ->cascadeOnDelete();
            $table->text('description');
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
        Schema::dropIfExists('document_normative_instruction_attachments');
    }
};
