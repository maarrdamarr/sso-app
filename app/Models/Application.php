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

    // di App\Models\Application
    public function category()
    {
        return $this->belongsTo(\App\Models\ApplicationCategory::class, 'application_category_id');
    }
}
