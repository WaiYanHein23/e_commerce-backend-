<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $products=Product::all();

        if($products->count() ==0 ){
            return response()->json([

              "message"=>"No products found"

            ]);
        }
            else{
                return response()->json([
                    "products"=>$products
                ]);
            }


    }

    public function store(){
        $validator=Validator::make(request()->all(),[
            'category_id'=>['required'],
            'brand_id'=>['required'],
            'color_id'=>['required'],
            'size_id'=>['required'],
            'product_price_id'=>['required'],
            'name'=>['required'],
            'image_path'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>'unprocessable',
                'error'=>$validator->errors()
            ],422);
        }

        $path = request()->file('image_path')->store('images','public');

        $product=Product::create([
            'category_id'=>request('category_id'),
            'brand_id'=>request('brand_id'),
            'color_id'=>request('color_id'),
            'size_id'=>request('size_id'),
            'product_price_id'=>request('product_price_id'),
            'name'=>request('name'),
            'image_path'=>asset(`storage/.$path`),
        ]);


        return response()->json([
            'message'=>'Product created successfully',
            'product'=>$product,

        ]);

    }

    public function show(Product $product){

        return response()->json([
            'product' => $product,
        ], 200);

    }

    public function update(Product $product){

        $validator=Validator::make(request()->all(),[
            'category_id'=>['required'],
            'brand_id'=>['required'],
            'color_id'=>['required'],
            'size_id'=>['required'],
            'product_price_id'=>['required'],
            'name'=>['required'],
            'image_path'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',


        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>'unprocessable',
                'error'=>$validator->errors()
            ],422);
        }

        $product->update(request()->all());

        return response()->json([

        "message"=>"Update successfully",
        "product"=>$product
        ]);
    }

    public function destroy(Product $product){
        $product->delete();

        return response()->json([
            "message"=>"Product deleted successfully",
            "product"=>$product
        ]);

    }

}
