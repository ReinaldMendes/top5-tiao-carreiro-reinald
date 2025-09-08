<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sugestao extends Model
{
    use HasFactory;

    // Adicione esta linha para indicar a tabela correta
    protected $table = 'sugestoes';

    protected $fillable = [
        'titulo',
        'youtube_id',
        'thumb',
        'status',
    ];
}
