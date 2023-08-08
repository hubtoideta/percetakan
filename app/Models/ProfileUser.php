<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileUser extends Model
{
    
    protected $table = 'profile_users';
    protected $primaryKey = 'username';
    
}
