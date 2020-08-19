<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article_menu extends Model
{
    protected $table = 'article_menus';
    protected $fillable = ['article_menu_id','category_id','name','slug','plus','parent','parent','is_active','hot','sort','menu_main','sort_hide','menu_sm','images'];
}
