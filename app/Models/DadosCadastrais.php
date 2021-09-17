<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DadosCadastrais extends Model
{
    protected $table = 'dados_cadastrais';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
