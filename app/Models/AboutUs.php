<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $fillable = [
        'about_us',
        'our_vision',
        'our_mission',
        'why_us',
    ];
}
