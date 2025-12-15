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
        if (!Schema::hasTable('orcamentos')) {
            Schema::create('orcamentos', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid');
                $table->string('type');
                $table->integer('year');
                $table->integer('month');
                $table->bigInteger('value')->nullable();
                $table->text('description');
                $table->text('observation')->nullable();
                $table->timestamps();
            });
        }
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orcamento');
    }
};
