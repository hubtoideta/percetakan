<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class EmployedOwner extends Model
{
    protected $table = "employed_owners";
    public $timestamps = false;

    protected $fillable = [
        'id_store',
        'username',
        'role',
        'status',
    ];
}
