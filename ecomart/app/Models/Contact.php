<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $fillable = ['companyname','fullname','email','birthday','cmnd','address','phone','msthue','stk','is_active','kinhnghiem','slnhanvien','ptvanchuyen','comments'];
}
