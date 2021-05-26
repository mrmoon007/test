<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use CreateProductImagesTable;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function store(Request $request)
    {
        //return $request;

        // $data = $request->all();
        // $allData = $data['product'];
        // $image = $data['productImage'];


        $productId = Product::insertGetId([
            'title' => $request->title,
            'sku' => $request->sku,
            'description' => $request->description,
        ]);

        

        $productImage = ProductImage::create([
            'product_id' => $productId,
            'file_path' => $request->img,

        ]);

        

        // foreach ($data['variant'] as $item) {
            $ProductVariant = ProductVariant::create(
                [
                    'variant' => $request->variant,
                    'variant_id' => $request->variant_id,
                    'product_id' => $productId,
                ]
            );
        // }
        
        // foreach ($data['ports'] as $item) {
            $ProductVariantPrice = ProductVariantPrice::create(
                [
                    'product_id' => $productId,
                    'product_variant_one' => $request->variant_id,
                    'product_variant_two' => $request->variant_id,
                    'product_variant_three' => $request->variant_id,
                    'price' => $request->price,
                    'stock' => $request->stock,

                ]
            );
        // }

        return $productId ;
    }
}
