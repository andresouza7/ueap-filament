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
        Schema::table('web_posts', function (Blueprint $table) {
            // Criando a coluna como bigInteger e nullable
            $table->foreignId('web_menu_id')->nullable()->after('web_category_id')->constrained();

            $table->foreignId('web_category_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('web_posts', function (Blueprint $table) {
            // Removendo a coluna no rollback
            $table->dropForeign(['web_menu_id']);
            $table->dropColumn('web_menu_id');

            // Reverte a categoria para obrigatória (opcional, dependendo da sua regra)
            $table->foreignId('web_category_id')->nullable(false)->change();
        });
    }
};
