<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'whatsapp',
        'phone1',
        'phone2',
        'phone3',
        'email',
        'facebook',
        'tiktok',
        'instagram',
        'youtube',
    ];
}
