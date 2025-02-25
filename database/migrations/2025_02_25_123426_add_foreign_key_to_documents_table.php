<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('document_generals', function (Blueprint $table) {
            // Ensure the type column exists and is the same type as the slug column in document_categories
            $table->string('type')->change();

            // Add the foreign key constraint
            $table->foreign('type')->references('slug')->on('document_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_generals', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['type']);
        });
    }
};
