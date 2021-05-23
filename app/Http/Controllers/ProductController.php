<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
         $all_data = Product::with('product_variant','product_variant.product_viriant_price')->paginate(2);
         return view('products.index', compact('all_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $variants = Variant::all();
        return view('products.create', compact('variants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        $all_data = Product::all()->paginate(2);
        return view('all-datashow', compact('all_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $variants = Variant::all();
        return view('products.edit', compact('variants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function search(Request $request)
    {
        
        $title=$request->title;
        $variant=$request->variant;
        $price_from=$request->price_from;
        $price_to=$request->price_to;
        $date=$request->date;
        //return $data=$request->all();

        $result=Product::
                // with('product_variant','product_variant.product_viriant_price')->query();
                join('product_variants as pv','products.id','pv.product_id')
                ->join('product_variant_prices as pvp','products.id','pvp.product_id')
                //  ->get();
                ->select(
                    'products.id',
                    'products.title',
                    'pv.id',
                    'pv.variant',
                    'pvp.price',
                    
                );
        if(!empty($title)){
            //$result=$result->where('products.title',$title);
            $result=$result->where('products.title', 'LIKE', '%' . $title . '%');

        }
        // $data=$result->get();
        //   return $data;
        if(!empty($variant)){
            $result=$result->where('pv.variant',$variant);
        }
        //  $data=$result->get();
        //  return $data;
        if(!empty($price_from && $price_to )){

            $result=$result->where('price','<=',$price_to);
            $result=$result->where('price','>=',$price_from);


            // ->whereBetween('price', [$pricefrom, $priceto]);

            // ->where('price',$price);
        }
        // if(!empty($date)){
        //     $result=$result->where('created_at',$date);

        //     // ->where('expiry_date',$expiry_date);
        // }


      return  $result=$result->paginate(5);
        //return view('search',compact('result'));

    }
}
