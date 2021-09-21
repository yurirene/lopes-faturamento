<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = 'notas';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $dates = ['emissao', 'chegada', 'chegada_porto', 'data_entrega', 'data_reentrega', 'created_at', 'updated_at'];


    public function itens()
    {
        return $this->hasMany(ItensNota::class);
    }

    public function industria()
    {
        return $this->belongsTo(Industria::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
