<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Pega todos os posts que possuem uma categoria definida
        $posts = DB::table('web_posts')->whereNotNull('web_category_id')->get();

        foreach ($posts as $post) {
            DB::table('web_category_post')->insert([
                'web_post_id' => $post->id,
                'web_category_id' => $post->web_category_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('web_category_post')->truncate();
    }
};
