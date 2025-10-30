<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class, 'application_category_id');
    }
}
