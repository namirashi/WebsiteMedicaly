<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    protected $fillable = [
        'level',
        'message',
        'context',
        'ip_address',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}