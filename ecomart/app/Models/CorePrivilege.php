<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorePrivilege extends Model
{
    protected $table = 'core_privileges';
    protected $fillable = ['role_id','type','privilege_slug'];
}
