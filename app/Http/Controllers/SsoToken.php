<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SsoToken extends Model
{
    protected $fillable = [
        'user_id', 'application_id', 'token', 'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
