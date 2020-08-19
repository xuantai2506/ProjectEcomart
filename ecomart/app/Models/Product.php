<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['product_id','product_menu_id','name','slug','images','images_note','upload_images','upload_id','sale','price','guarantee','product_keys','comment','content','producer','producer_name','combo','is_active','hot','percent','pin','views','title','description','keywords','user_id'];
}
