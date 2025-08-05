<?php

namespace App\Console\Commands;

use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MigrateTransparencyOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-transparency-orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migra atas de registro de preço para tabela de documentos';

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
                'slug' => 'ata-registro-preco',
            ], [
                'uuid' => Str::uuid(),
                'name' => 'Ata de Registro de Preço',
                'description' => null,
                'status' => 'published'
            ]);

            $rows = DB::table('transparency_orders')->get();

            foreach ($rows as $row) {
                Document::create([
                    'uuid' => $row->uuid ?? (string) Str::uuid(),
                    'type' => $category->slug,
                    'title' => $row->title ?? 'Sem título',
                    'description' => $row->description ?? null,
                    'year' => $row->year ?? null,
                    'user_created_id' => $row->user_created_id ?? null,
                    'status' => 'published',
                    'metadata' => [
                        'number' => $row->number ?? null, 
                        'month' => $row->month ?? null,
                        'type' => $row->type ?? null,
                        'category' => $row->category ?? null
                    ],
                    'old_id' => $row->id
                ]);
            }
        });

        $this->info('Atas de registro de preço migradas!');
    }
}
