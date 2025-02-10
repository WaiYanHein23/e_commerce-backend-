<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(){
        $cleanData = request()->validate([
            'name' => 'required|min:2|unique:categories',
        ]);
        $category = Category::create($cleanData);
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

    public function delete($id){
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

    public function update(Category $category){
        $cleanData = request()->validate([
            'name' => 'required|min:2|unique:categories',
        ]);
        $category->update($cleanData);
        return response()->json([
            'status' => 200,
            'message' => 'Category updated successfully',
            'category' => $category->id,
        ],200);
    }

}
