<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterEmail extends Model
{
    protected $table = 'register_emails';
    protected $fillable = ['email','ip'];
}
