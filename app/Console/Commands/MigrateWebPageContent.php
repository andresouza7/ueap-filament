<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\WebPage;
use Illuminate\Support\Facades\Storage;

class MigrateWebPageContent extends Command
{
    protected $signature = 'webpages:migrate-content';
    protected $description = 'Migrate text and image fields into the content JSON structure';

    public function handle(): int
    {
        $this->info('Starting WebPage content migration...');

        WebPage::chunkById(50, function ($pages) {
            foreach ($pages as $page) {
                $content = [];

                /**
                 * 1. IMAGE → GALLERY NODE + MEDIA LIBRARY
                 */
                $path = 'web/pages/' . $page->id . '.jpg';

                if (Storage::exists($path)) {
                    // Register media (default collection)
                    if (! $page->hasMedia()) {
                        $page
                            ->addMedia(Storage::path($path))
                            ->preservingOriginal()
                            ->toMediaCollection();
                    }

                    $content[] = [
                        'type' => 'image',
                        'data' => [
                            'subtitle' => null,
                            'credits'  => null,
                        ],
                    ];
                }

                /**
                 * 2. TEXT NODE
                 */
                if (!empty($page->text)) {
                    $content[] = [
                        'type' => 'text',
                        'data' => [
                            'body' => $page->text,
                        ],
                    ];
                }

                /**
                 * 3. SAVE CONTENT
                 */
                if (!empty($content)) {
                    $page->content = $content;
                    $page->save();

                    $this->line("✔ Migrated page ID {$page->id}");
                }
            }
        });

        $this->info('Migration completed successfully.');

        return self::SUCCESS;
    }
}
