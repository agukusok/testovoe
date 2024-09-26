<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'username'
    ];

    public function hasRole($role)
       {
           return $this->role === $role; // Предполагается, что роль хранится в поле 'role'
       }

    public function getFullNameAttribute()
    {
        return $this->name;
    }
}
