<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sizes = Size::all();
        if ($sizes->count() == 0) {
            return response()->json([
                "message" => "Sizes not found"
            ],
            404);
        }
        return response()->json([
            "data" => $sizes
        ],
        200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|unique:sizes"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ],
            422);
        }

        $size = Size::create([
            "name" => $request->name
        ]);

        return response()->json([
            "message" => "Size created successfully",
            "id" => $size->id
        ],
        200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $size = Size::find($id);
        if ($size) {
            return response()->json([
                "data" => $size
            ],
            200);
        } else {
            return response()->json([
                "message" => "Size not found"
            ],
            404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|unique:sizes"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ],
            422);
        }

        $size = Size::find($id);

        if ($size) {
            $size->name = $request->name;
            $size->save();

            return response()->json([
                "message" => "Size updated successfully",
                "id" => $size->id
            ],
            200);
        } else {
            return response()->json([
                "message" => "Size not found"
            ],
            404);
        }
    } // **Closing bracket added here!**

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $size = Size::find($id);

        if ($size) {
            $size->delete();

            return response()->json([
                "message" => "Size deleted successfully",
                "id" => $size->id

            ],
            200);
        } else {
            return response()->json([
                "message" => "Size id is not found"
            ],
            404);
        }
    }
}
