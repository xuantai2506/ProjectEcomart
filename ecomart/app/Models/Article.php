<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    
 	protected $table = 'articles';
    protected $fillable = ['article_id','article_menu_id','name','slug','title','description','keywords','images','images_note','address','upload_id','comment','content','is_active','hot','views','user_id'];

}
