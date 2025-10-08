<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles'; // make sure this matches your table name
    protected $fillable = ['name', 'guard_name']; // adjust as per your columns
}
