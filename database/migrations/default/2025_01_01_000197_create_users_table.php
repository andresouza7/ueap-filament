<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('user_type')->nullable();
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('group_id');
            $table->string('login');
            $table->string('password');
            $table->string('ramal')->nullable();
            $table->string('enrollment')->nullable();

            $table->unsignedBigInteger('effective_role_id')->nullable();
            $table->unsignedBigInteger('commissioned_role_id')->nullable();

            $table->string('effective_role_desc')->nullable();
            $table->string('commissioned_role_desc')->nullable();

            $table->string('use_protocol')->nullable();
            $table->string('has_commissioned')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token', 100)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->uuid('uuid');
            $table->string('email')->nullable();
            $table->unsignedBigInteger('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();

            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->timestamp('two_factor_confirmed_at')->nullable();

            $table->string('gauth_id')->nullable();
            $table->string('gauth_type')->nullable();

            $table->boolean('skip_tutorial')->default(false);

            // Unique constraints
            $table->unique('uuid');

            // Foreign keys
            $table->foreign('commissioned_role_id')
                ->references('id')->on('commissioned_roles')
                ->onDelete('cascade');

            $table->foreign('effective_role_id')
                ->references('id')->on('effective_roles')
                ->onDelete('cascade');

            $table->foreign('group_id')
                ->references('id')->on('groups')
                ->onDelete('cascade');

            $table->foreign('person_id')
                ->references('id')->on('persons')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
