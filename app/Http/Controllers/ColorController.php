<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = Color::all();
        if ($colors->count() == 0) {
            return response()->json([
                "message" => "Colors not found"
            ],
            404);
        }
        return response()->json([
            "data" => $colors
        ],
        200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|unique:colors"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ],
            422);
        }

        $color = Color::create([
            "name" => $request->name
        ]);

        return response()->json([
            "message" => "Color created successfully",
            "id" => $color->id
        ],
        200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $color = Color::find($id);
        if ($color) {
            return response()->json([
                "data" => $color
            ],
            200);
        } else {
            return response()->json([
                "message" => "Color not found"
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
            "name" => "required|unique:colors"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ],
            422);
        }

        $color = Color::find($id);

        if ($color) {
            $color->name = $request->name;
            $color->save();

            return response()->json([
                "message" => "Color updated successfully",
                "id" => $color->id
            ],
            200);
        } else {
            return response()->json([
                "message" => "Color not found"
            ],
            404);
        }
    } // **Closing bracket added here!**

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $color = Color::find($id);

        if ($color) {
            $color->delete();

            return response()->json([
                "message" => "Color deleted successfully",
                "id" => $color->id

            ],
            200);
        } else {
            return response()->json([
                "message" => "Color id is not found"
            ],
            404);
        }
    }
}
