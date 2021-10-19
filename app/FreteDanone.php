<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FreteDanone extends Model
{
    protected $table = 'frete_danones';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
