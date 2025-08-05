<?php

namespace App\Console\Commands;

use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MigrateTransparencyBidDocuments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-bid-documents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migra anexos de licitação para a tabela de documentos';

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
                'slug' => 'licitacao-anexo',
            ], [
                'uuid' => Str::uuid(),
                'name' => 'Anexo de Licitação',
                'description' => null,
                'status' => 'published'
            ]);

            $rows = DB::table('transparency_bid_documents')->get();

            foreach ($rows as $row) {
                Document::create([
                    'uuid' => $row->uuid ?? (string) Str::uuid(),
                    'type' => $category->slug,
                    'title' => $row->description ?? 'Sem título',
                    'description' => null,
                    'year' => $row->year ?? null,
                    'user_created_id' => $row->user_created_id ?? null,
                    'status' => 'published',
                    'metadata' => ['number' => $row->number ?? null, 'transparency_bid_id' => $row->transparency_bid_id ?? null],
                    'old_id' => $row->id
                ]);
            }
        });

        $this->info('Anexos de licitação do consu migrados!');
    }
}
