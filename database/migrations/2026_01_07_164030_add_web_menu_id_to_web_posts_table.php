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
            
            // Opcional: Se você quiser adicionar a restrição de chave estrangeira, descomente a linha abaixo:
            // $table->foreign('web_menu_id')->references('id')->on('web_menus')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('web_posts', function (Blueprint $table) {
            // Removendo a coluna no rollback
            $table->dropColumn('web_menu_id');
        });
    }
};