<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
{
    protected $table = 'category_types';
    protected $fillable = ['name','slug','sort','is_active'];
}
