<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Online extends Model
{
    protected $table = 'onlines';
    protected $fillable = ['ip','site','agent','user_id'];
}
