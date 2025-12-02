<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_appointments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            // FK para o servidor que solicitou
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Dados do agendamento
            $table->string('agent_role');
            $table->date('requested_date');
            $table->text('patient_note')->nullable();
            $table->text('cancellation_note')->nullable();
            $table->string('status')->default('Novo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('health_appointments');
    }
};
