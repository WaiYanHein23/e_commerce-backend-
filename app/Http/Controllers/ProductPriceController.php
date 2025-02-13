<?php

namespace App\Http\Controllers;

use App\Models\ProductPrice;
use Illuminate\Http\Request;

class ProductPriceController extends Controller
{
    public function store(){
        $cleanData = request()->validate([
            'grade_id' => 'required',
            'size_id' => 'required',
            'color_id' => 'required',
            'product_id' => 'required',
            'price' => 'required'
        ]);

        $product_prices = ProductPrice::create($cleanData);
        return response()->json([
            'status' => 200,
            'message' => 'Product Prices created successfully',
            'id' => $product_prices->id
        ],200);
    }

    public function index(){
        $product_prices = ProductPrice::all();
        return response()->json([
            'status' => 200,
            'message' => "product_prices retrieved successfully",
            'product_prices' => $product_prices
        ],200);
    }

    public function show(ProductPrice $product_prices){
        return response()->json([
            'status' => 200,
            'message' => 'product price retrieved successfully',
            'product_prices' => $product_prices
        ],200);
    }

    public function update(ProductPrice $product_prices){
        $cleanData = request()->validate([
            'grade_id' => 'required',
            'size_id' => 'required',
            'color_id' => 'required',
            'product_id' => 'required',
            'price' => 'required'
        ]);
        $product_prices->update($cleanData);
        return response()->json([
            'status' => 200,
            'message' => 'product_prices updated successfully',
            'id' => $product_prices->id
        ],200);
    }

    public function delete($id){
        $product_prices = ProductPrice::find($id);
        if(!$product_prices){
            return response()->json([
                'status' => 404,
                'message' => 'product_prices not found'
            ],404);
        }

        $product_prices->delete();
        return response()->json([
            'status' => 200,
            'message' => 'product_prices deleted successfully',
            'id' => $product_prices->id
        ],200);
    }
}
