<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $dates = ['created_at'];


    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class)->withTrashed();
    }
}
