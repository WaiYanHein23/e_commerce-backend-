<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Color::all();
        if ($grades->count() == 0) {
            return response()->json([
                "message" => "Grades not found"
            ],
            404);
        }
        return response()->json([
            "data" => $grades
        ],
        200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|unique:grades"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ],
            422);
        }

        $grade = Grade::create([
            "name" => $request->name
        ]);

        return response()->json([
            "message" => "Grade created successfully",
            "id" => $grade->id
        ],
        200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $grade = Color::find($id);
        if ($grade) {
            return response()->json([
                "data" => $grade
            ],
            200);
        } else {
            return response()->json([
                "message" => "Grade not found"
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
            "name" => "required|unique:grades"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ],
            422);
        }

        $grade = Grade::find($id);

        if ($grade) {
            $grade->name = $request->name;
            $grade->save();

            return response()->json([
                "message" => "Grade updated successfully",
                "id" => $grade->id
            ],
            200);
        } else {
            return response()->json([
                "message" => "Grade not found"
            ],
            404);
        }
    } // **Closing bracket added here!**

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $grade = Grade::find($id);

        if ($grade) {
            $grade->delete();

            return response()->json([
                "message" => "Grade deleted successfully",
                "id" => $grade->id

            ],
            200);
        } else {
            return response()->json([
                "message" => "Grade id is not found"
            ],
            404);
        }
    }
}
