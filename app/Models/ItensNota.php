<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItensNota extends Model
{
    protected $table = 'itens_notas';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
