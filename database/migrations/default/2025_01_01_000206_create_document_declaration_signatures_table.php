<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_declaration_signatures', function (Blueprint $table) {
            $table->uuid('uuid')->primary();

            $table->uuid('commissioned_role_uuid');
            $table->uuid('signer_uuid');

            $table->string('legal_document');
            $table->boolean('substitute')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreign('commissioned_role_uuid')
                ->references('uuid')
                ->on('commissioned_roles')
                ->onUpdate('no action')
                ->onDelete('no action');

            $table
                ->foreign('signer_uuid')
                ->references('uuid')
                ->on('persons')
                ->onUpdate('no action')
                ->onDelete('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_declaration_signatures');
    }
};
