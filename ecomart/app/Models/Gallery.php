<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';
    protected $fillable = ['gallery_id','product_menu_id','gallery_menu_id','name','slug','title','description','keywords','images','upload_id','comment','content','link','is_active','hot','views','user_id'];
}
