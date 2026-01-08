<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Cria a coluna como nullable
        Schema::table('web_posts', function (Blueprint $table) {
            $table->string('type')->nullable()->after('web_category_id');
        });

        // 2. Atualiza os dados existentes com base na lógica solicitada
        DB::table('web_posts')->update([
            'type' => DB::raw("CASE 
                WHEN web_category_id = 17 THEN 'event' 
                ELSE 'news' 
            END")
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('web_posts', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};