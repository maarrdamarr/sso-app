<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable; // Sanctum kita lepas karena kamu ga pakai API

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'department_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // relasi ke roles (many to many)
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // relasi ke department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // helper untuk cek role
    public function hasRole(string|array $roles): bool
    {
        $userRoles = $this->roles->pluck('name')->toArray();

        if (is_string($roles)) {
            return in_array($roles, $userRoles);
        }

        return count(array_intersect($roles, $userRoles)) > 0;
    }
}
