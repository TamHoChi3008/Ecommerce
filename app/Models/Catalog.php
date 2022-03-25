<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'catalog_name', 'catalog_parent'
    ];
    protected $primaryKey = 'catalog_id';
    protected $table = 'catalog';

    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }
}
