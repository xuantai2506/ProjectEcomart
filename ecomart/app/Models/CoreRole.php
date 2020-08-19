<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoreRole extends Model
{
    protected $table = 'core_roles';
    protected $fillable = ['name','comment','is_active'];
}
