<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    protected $table = 'others';
    protected $fillable = ['others_id','others_menu_id','name','slug','p_from','p_to','sort','is_active','hot','user_id'];
}
