<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id', 'variant', 'variant_id'
    ];
    public function product_viriant_price()
    {
        return $this->hasOne(ProductVariantPrice::class, 'product_id');
    }
}
