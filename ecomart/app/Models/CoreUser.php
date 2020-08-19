<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoreUser extends Model
{
    protected $table = 'core_users';
    protected $fillable = ['role_id','user_name','password','full_name','gender','birthday','apply','email','phone','address','comment','code','is_show','city','district','sort','images','is_active','token','vote','click_vote','user_id_edit','province_id','district_id','ward_id'];
}
