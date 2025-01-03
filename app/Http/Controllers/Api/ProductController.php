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
            'name'=>['required'],
            'description'=>['required'],
            'price'=>['required'],
            'quantity'=>['required'],

        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>'unprocessable',
                'error'=>$validator->errors()
            ],422);
        }

        $product=Product::create(request()->all());


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
            'name'=>['required'],
            'description'=>['required'],
            'price'=>['required'],
            'quantity'=>['required'],

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
