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
        Schema::create('protocol_process_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('protocol_process_id');
            $table->unsignedBigInteger('user_sent_id')->nullable();
            $table->unsignedBigInteger('user_received_id')->nullable();
            $table->unsignedBigInteger('group_sent_id')->nullable();
            $table->unsignedBigInteger('group_received_id')->nullable();
            $table->text('description')->nullable();
            $table->text('parecer')->nullable();
            $table->timestamp('date_sent')->nullable();
            $table->timestamp('date_received')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('_delete_')->nullable();

            // Foreign key example (opcional, se quiser reforçar integridade)
            // $table->foreign('protocol_process_id')->references('id')->on('protocol_processes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('protocol_process_histories');
    }
};
