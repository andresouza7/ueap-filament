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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // usuário que enviou
            $table->text('file_id')->nullable();
            $table->text('file_path')->nullable(); // arquivo temporário
            $table->integer('month');
            $table->integer('year');
            $table->enum('status', ['pendente', 'aprovado', 'rejeitado'])->default('pendente');
            $table->foreignId('evaluador_id')->nullable()->constrained('users'); // avaliador RH
            $table->date('evaluated_at')->nullable();
            $table->text('user_notes')->nullable();
            $table->text('evaluator_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};