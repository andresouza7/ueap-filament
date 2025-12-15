<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->string('name');
            $table->string('cpf_cnpj')->unique();
            $table->date('birthdate')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->uuid('uuid')->unique();
            $table->string('lattes')->nullable();
            $table->text('resume')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
