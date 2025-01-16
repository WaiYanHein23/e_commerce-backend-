<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator=Validator::make(request()->all(),[
            "post_id"=>['required'],

        ]);

        if($validator->fails()){
            return response()->json([
                "message"=>"Unprocessable",
                "error"=>$validator->errors()
            ]);
        }

        $postLike=Like::where("user_id",auth()->user()->id)->where("post_id",$request->post_id)->first();

        if($postLike){
            return response()->json([
              "message"=>"You have already liked this post"

            ]);
        }

        $like=Like::create([
            "user_id"=>auth()->user()->id,
            "post_id"=>$request->post_id,
        ]);

        return response()->json([
            "message"=>"Like created successfully",
            "data"=>$like
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        //
    }
}
