<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery_menu extends Model
{
    protected $table = 'gallery_menus';
    protected $fillable = ['gallery_menu_id','category_id','name','slug','title','description','keywords','parent','images','sort','comment','is_active','hot','user_id'];
}
