<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $courses = [
            'Engenharia Florestal',
            'Engenharia de Pesca',
            'Engenharia de Produção',
            'Engenharia Química',
            'Engenharia Ambiental',
            'Licenciatura em Pedagogia',
            'Licenciatura em Química',
            'Licenciatura em Ciências Naturais',
            'Licenciatura em Letras',
            'Licenciatura em Filosofia',
            'Engenharia Agronômica',
            'Licenciatura em Matemática',
            'Especialização em Gestão Pública',
            'Especialização em Gestão Escolar',
            'Especialização em Ciências Naturais',
            'Especialização em Educação do Campo',
        ];
        
        foreach($courses as $course) {
            Course::create(['name' => $course]);
        }
    }
}
