<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auth_Admin extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'admin_name', 'admin_email', 'admin_password'
    ];
    protected $primaryKey = 'admin_id';
    protected $table = 'admin';
}

?>
