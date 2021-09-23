<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frete extends Model
{
    protected $table = 'fretes';
    protected $guarded = ['id', 'created_at', 'updated_at']; 
}
