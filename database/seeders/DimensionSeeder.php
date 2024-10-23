<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Dimension;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DimensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $dimensions = [
            'Dimensão I: Missão e Plano de Desenvolvimento Institucional',
            'Dimensão II: Políticas para o Ensino, Pesquisa e Extensão',
            'Dimensão III: Responsabilidade social da instituição',
            'Dimensão IV: Comunicação com a sociedade',
            'Dimensão V: Políticas de Pessoal',
            'Dimensão VI: Organização e gestão da instituição',
            'Dimensão VII: Infraestrutura física',
            'Dimensão VIII: Planejamento e Avaliação',
            'Dimensão IX: Política de atendimento aos estudantes',
            'Dimensão X: Sustentabilidade financeira',
        ];

        $categories = Category::where('name', '<>', 'SOCIEDADE CIVIL')->get();
        foreach($categories as $category) {
            foreach($dimensions as $dimension) {
                Dimension::create([
                    'name' => $dimension,
                    'category_id' => $category->id
                ]);
            }
        }

        $sociedade = Category::where('name', 'SOCIEDADE CIVIL')->first();
        Dimension::create([
            'name' => 'Dimensão: Comunicação com a sociedade',
            'category_id' => $sociedade->id
        ]);
    }
}
