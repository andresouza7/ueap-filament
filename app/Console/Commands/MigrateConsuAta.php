<?php

namespace App\Console\Commands;

use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MigrateConsuAta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-consu-ata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migra atas do consu para a tabela DocumentGenerals';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::transaction(function () {
            // $mappings = [
            //     'consu_atas' => ['name' => 'Ata do Consu', 'fields' => ['title', 'issuer', 'issuance_date']],
            //     'consu_resolutions' => ['name' => 'Resolução do Consu', 'fields' => ['number', 'name']],
            //     'document_ordinances' => ['name' => 'Portaria', 'fields' => ['number', 'subject', 'origin']],
            //     'transparency_bid_documents' => ['name' => 'Documento de Licitação', 'fields' => ['number', 'location', 'link', 'observation', 'start_date']],
            //     'transparency_orders' => ['name' => 'Ordem de Transparência', 'fields' => ['month']],
            // ];

            $category = DocumentCategory::firstOrCreate([
                'slug' => 'consu-atas',
            ], [
                'uuid' => Str::uuid(),
                'name' => 'Atas do Consu',
                'description' => null,
                'status' => 'published'
            ]);

            $rows = DB::table('consu_atas')->get();

            foreach ($rows as $row) {
                Document::create([
                    'uuid' => $row->uuid ?? (string) Str::uuid(),
                    'type' => $category->slug,
                    'title' => $row->title ?? $row->title ?? 'Sem título',
                    'description' => $row->description ?? null,
                    'year' => $row->year ?? null,
                    'user_created_id' => $row->user_created_id ?? null,
                    'status' => 'published',
                    'metadata' => ['issuer' => $row->issuer, 'issuance_date' => $row->issuance_date],
                    'old_id' => $row->id
                ]);
            }
        });

        $this->info('Atas do consu migradas!');
    }
}
