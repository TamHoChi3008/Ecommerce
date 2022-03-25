<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'detail_order_code', 'product_image_link', 'detail_product_id	', 'detail_qty', 'detail_product_price', 'detail_size', 'detail_product_name', 'detail_product_discount'
    ];
    protected $primaryKey = 'detail_id';
    protected $table = 'order_details';
}
