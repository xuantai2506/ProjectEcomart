<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oder extends Model
{
    protected $table = 'oders';
    protected $fillable = ['name','name_dif','phone','phone_dif','email','email_dif','address_detail','address','address_dif_detail','address_dif','content','method_purchase','id_product','price','quantity','user_id','is_view','is_show'];
}
