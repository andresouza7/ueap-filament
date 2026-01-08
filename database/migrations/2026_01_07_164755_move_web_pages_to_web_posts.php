<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Buscamos todos os registros de web_pages
        $pages = DB::table('web_pages')->get();

        foreach ($pages as $page) {
            DB::table('web_posts')->insert([
                'web_category_id' => $page->web_category_id,
                'web_menu_id'     => $page->web_menu_id,
                'slug'            => $page->slug,
                'title'           => $page->title,
                'text'            => $page->text,
                'content'         => $page->content, // Campo adicional solicitado
                'type'            => 'page',         // Identificador para diferenciar de news/event
                'status'          => $page->status,
                'hits'            => $page->hits,
                'uuid'            => $page->uuid,
                'user_created_id' => $page->user_created_id,
                'user_updated_id' => $page->user_updated_id,
                'created_at'      => $page->created_at,
                'updated_at'      => $page->updated_at,
                'deleted_at'      => $page->deleted_at,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove os registros que foram movidos (baseado no tipo 'page')
        DB::table('web_posts')->where('type', 'page')->delete();
    }
};