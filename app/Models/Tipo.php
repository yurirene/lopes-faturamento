<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipo extends Model
{
    use SoftDeletes;
    
    protected $table = 'tipos';
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    
}
