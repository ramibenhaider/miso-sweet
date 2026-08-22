<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_id',
        'message',
        'phone',
        'is_shown',
    ];

    protected $casts = [
        'is_shown' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
