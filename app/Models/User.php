<?php

// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    use HasFactory;

    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password'];

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }
}