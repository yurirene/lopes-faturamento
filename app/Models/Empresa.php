<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{

    protected $table = 'empresas';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    
    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
