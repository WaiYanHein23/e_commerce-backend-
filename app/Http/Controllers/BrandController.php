<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands=Brand::all();
        if ($brands->count() == 0) {
            return response()->json([
                "message"=>"Brands not found"
            ],
            404);
        }
        return response()->json([
            "data"=>$brands
        ],
        200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator =Validator::make($request->all(), [
            "name" => "required|unique:brands"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ],
            422);
        }

        $brand =Brand::create([
            "name" => $request->name
        ]);

        return response()->json([
            "message" => "Brand created successfully",
            "id" => $brand->id
        ],
        200);



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $brand = Brand::find($id);
        if ($brand) {
            return response()->json([
                "data" => $brand
            ],
            200);
        } else {
            return response()->json([
                "message" => "Brand not found"
            ],
            404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            "name" => "required|unique:brands"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ],
            422);
        }

        $brand = Brand::find($id);

        if ($brand) {
            $brand->name = $request->name;
            $brand->save();

            return response()->json([
                "message" => "Brand updated successfully",
               "id" => $brand->id
            ],
            200);
        } else {
            return response()->json([
                "message" => "Brand not found",
            ],
            404);


        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);

        if ($brand) {
            $brand->delete();

            return response()->json([
                "message" => "Brand deleted successfully",
                "id" => $brand->id
            ],
            200);
        } else {
            return response()->json([
                "message" => "Brand id is  not found"
            ],
            404);

        }
    }
}
