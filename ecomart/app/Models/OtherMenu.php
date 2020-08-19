<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherMenu extends Model
{
    protected $table = "other_menus";
    protected $fillable = ['others_menu_id','category_id','name','slug','plus','menu','parent','sort','is_active','hot','user_id'];
}
