<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessRequest extends Model
{
    protected $fillable = [
        'user_id',
        'application_id',
        'reason',
        'status',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
