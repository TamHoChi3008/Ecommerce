<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giftcode extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'giftcode_name', 'giftcode_times', 'giftcode_condidtion', 'giftcode_discount'
    ];
    protected $primaryKey = 'giftcode_id';
    protected $table = 'giftcode';
}
