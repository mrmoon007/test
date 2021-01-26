<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'sku', 'description'
    ];

    public function productViriant()
    {
        return $this->hasOne('App\ProductVariant', 'product_id');
    }
    public function productViriantPrice()
    {
        return $this->hasOne('App\ProductVariantPrice', 'product_id');
    }
}
