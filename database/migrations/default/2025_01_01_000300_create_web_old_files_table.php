<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('web_old_files', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('size')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('name')->nullable();
            $table->string('mimetype')->nullable();
            $table->string('description')->nullable();
            $table->string('codname')->nullable();
            $table->string('_del_')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('web_old_files');
    }
};
