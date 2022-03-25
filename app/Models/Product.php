<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'product_catalog_id', 
        'product_name',
        'product_quantity', 
        'product_price',
         'product_content',
          'product_discription',
           'product_discount',
            'product_image_link'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'product';
    public function catalog(){
        return $this->belongsTo('App\Models\Catalog','product_catalog_id','catalog_id');
    }
}
