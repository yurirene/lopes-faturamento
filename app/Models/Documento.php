<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $dates = ['created_at'];

    public const TIPO = [
        1 => 'Documento 1',
        2 => 'Documento 2',
        3 => 'Documento 3',
        4 => 'Documento 4'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
