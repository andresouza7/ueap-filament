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
        Schema::create('document_declarations', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('demandant_uuid');
            $table->uuid('issuer_uuid');
            $table->string('type');
            $table->text('content');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('demandant_uuid')
                ->references('uuid')->on('users')
                ->onUpdate('no action')
                ->onDelete('no action');

            $table->foreign('issuer_uuid')
                ->references('uuid')->on('users')
                ->onUpdate('no action')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_declarations');
    }
};
