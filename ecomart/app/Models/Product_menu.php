<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_menu extends Model
{
    protected $table = 'product_menus';
    protected $fillable = ['product_menu_id','category_id','name','slug','plus','title','description','parent','images','sort','icon','color','is_active','hot','user_id','class'];
}
