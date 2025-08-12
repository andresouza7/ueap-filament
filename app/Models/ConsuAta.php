<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // pesquisar: HasFactory.
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsuAta extends Model // só comentando, esta classe Model é do Eloquent, 
                             // ela é necessária para fazer a parte de banco.
{
    use HasFactory, SoftDeletes; // ainda falta descobrir o que é o SoftDeletes, mas de certeza é do Filament...


    protected $dates = [  // porque é protected?
        'issuance_date'
    ];

    protected $fillable = [  // estes são (provavelmente) os dados da lógica de negócio. 
        'uuid',
        'title',
        'issuer',
        'issuance_date',
        'description',
        'hits',
        'user_created_id'
    ];

}

/* um dos documentos que foi mandado eu aprender. 
   no caso, este aqui gera um tipo de documento específico. 
*/

