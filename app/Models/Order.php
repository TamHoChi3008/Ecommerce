<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'ord_transaction_id', 'ord_code', 'ord_id_user', 'ord_name', 'ord_giftcode', 'ord_total', 'ord_status', 'ord_created'
    ];
    protected $primaryKey = 'ord_id';
    protected $table = 'order';
}
