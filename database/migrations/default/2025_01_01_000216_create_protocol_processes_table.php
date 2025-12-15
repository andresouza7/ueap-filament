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
        Schema::create('protocol_processes', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('external_number')->nullable();
            $table->text('description');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('user_sent_id')->nullable();
            $table->unsignedBigInteger('user_received_id')->nullable();
            $table->unsignedBigInteger('group_sent_id')->nullable();
            $table->unsignedBigInteger('group_received_id')->nullable();
            $table->string('status');
            $table->string('archive')->nullable();
            $table->text('archive_description')->nullable();
            $table->string('received')->nullable();
            $table->unsignedBigInteger('subject_id');
            $table->timestamps(); // created_at e updated_at
            $table->softDeletes(); // deleted_at
            $table->string('_delete_')->nullable();

            // Você pode adicionar constraints e foreign keys aqui depois se quiser
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('protocol_processes');
    }
};
