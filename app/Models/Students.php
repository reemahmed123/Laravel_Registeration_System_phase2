<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    //put fields my app will deal with 

    protected $table = 'students'; // optional if your table is "users"

    protected $fillable = [
        'full_name',
        'user_name',
        'phone',
        'whatsapp',
        'address',
        'email',
        'password',
        'user_image',
    ];
}
