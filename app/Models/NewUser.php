<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewUser extends Model
{
    use HasFactory;
    protected $table = 'new_users';
    protected $primaryKey = 'uid';
    protected $fillable = ['firstname', 'lastname', 'email', 'password', 'status', 'role'];
}