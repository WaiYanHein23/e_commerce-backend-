<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function store(){
         request()->validate([
            'name' => 'required|min:2|unique:categories',
            'status'=>'required'
        ]);
        $category = Category::create([
            'name' => request('name'),
            'status' => request('status')
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Category created successfully',
            'id' => $category->id,
        ],200);

    }

    public function index(){
        $categories = Category::all();
        return response()->json([
            'status' => 200,
            'message' => 'Category retrieved successfully',
            'categories' => $categories,
        ],200);
    }

    public function show(Category $category){
            return response()->json([
                'status' => 200,
                'message' => 'Category retrieved successfully',
                'category' => $category,
            ],200);
    }

    public function destroy($id){
        $category = Category::find($id);
        if(!$category){
            return response()->json([
                'status' => 404,
                'message' => 'Category not found',
            ],404);
        }
        $category->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Category deleted successfully',
            'id' => $category->id,
        ],200);
    }

    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            "name" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()
            ],
            422);
        }

        $category = Category::find($id);

        if ($category) {
            $category->name = $request->name;
            $category->status = $request->status;
            $category->save();

            return response()->json([
                "message" => "Category updated successfully",
               "id" => $category->id
            ],
            200);
        } else {
            return response()->json([
                "message" => "Category not found",
            ],
            404);


        }
    }

}
