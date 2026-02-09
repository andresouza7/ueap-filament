<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\WebPost;
use Illuminate\Support\Facades\Storage;

class MigrateWebPostContent extends Command
{
    protected $signature = 'webposts:migrate-content';
    protected $description = 'Migrate text and image fields into the content JSON structure';

    public function handle(): int
    {
        $this->info('Starting WebPost content migration...');

        WebPost::chunkById(50, function ($posts) {
            foreach ($posts as $post) {
                $content = [];

                /**
                 * 1. IMAGE → GALLERY NODE + MEDIA LIBRARY
                 */
                $path = 'web/posts/' . $post->id . '.jpg';

                if (Storage::exists($path)) {
                    // Register media (default collection)
                    // if (! $post->hasMedia()) {
                    //     $post
                    //         ->addMedia(Storage::path($path))
                    //         ->preservingOriginal()
                    //         ->toMediaCollection();
                    // }

                    $content[] = [
                        'type' => 'image',
                        'data' => [
                            'subtitle' => $post->image_subtitle,
                            'credits'  => $post->image_credits,
                            'path' => [$path]
                        ],
                    ];
                }

                /**
                 * 2. TEXT NODE
                 */
                if (!empty($post->text)) {

                    // Remove parágrafos vazios ou com apenas &nbsp; (lixo do editor antigo)
                    $cleanBody = preg_replace('/<p[^>]*>(?:&nbsp;|\s)*<\/p>/iu', '', $post->text);

                    // Limpa caracteres especiais e espaços extras
                    $cleanBody = clean_text($cleanBody);

                    $content[] = [
                        'type' => 'text',
                        'data' => [
                            'body' => $cleanBody,
                        ],
                    ];
                }

                /**
                 * 3. SAVE CONTENT
                 */
                if (!empty($content)) {
                    $post->content = $content;
                    $post->save();

                    $this->line("✔ Migrated post ID {$post->id}");
                }
            }
        });

        $this->info('Migration completed successfully.');

        return self::SUCCESS;
    }
}
