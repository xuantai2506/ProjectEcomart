<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['category_id','type_id','name','slug','is_active','hot','sort','menu_main','sort_hide','menu_sm','images','user_id'];
}
