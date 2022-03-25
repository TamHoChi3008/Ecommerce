<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'trans_user_fullname', 'trans_user_phone', 'trans_user_address', 'trans_note'
    ];
    protected $primaryKey = 'trans_id';
    protected $table = 'transaction';
}
