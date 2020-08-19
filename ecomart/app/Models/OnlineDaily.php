<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlineDaily extends Model
{
    protected $table = 'online_dailies';
    protected $fillable = ['count'];
}
