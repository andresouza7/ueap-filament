<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consu_atas', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->uuid('uuid')->unique();
            $table->string('title');
            $table->string('description')->nullable();
            $table->integer('hits');

            $table->unsignedBigInteger('user_created_id');
            $table->unsignedBigInteger('user_updated_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->string('issuer');
            $table->date('issuance_date');

            // FKs
            $table->foreign('user_created_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('user_updated_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consu_atas');
    }
};
