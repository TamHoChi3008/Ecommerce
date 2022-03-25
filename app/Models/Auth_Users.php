<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Auth_Users extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'user_name', 'user_email', 'user_phone', 'user_password, user_gitfcode', 'user_timesCode'
    ];
    protected $primaryKey = 'user_id';
    protected $table = 'users';
}
