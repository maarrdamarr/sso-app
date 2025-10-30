<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'url',
        'icon',
        'active',
    ];

        public function roles()
    {
        return $this->belongsToMany(Role::class, 'application_role');
    }
}
