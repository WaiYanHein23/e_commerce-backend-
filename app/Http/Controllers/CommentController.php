<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments=Comment::all();

        return response()->json([
            "data"=>$comments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator=Validator::make(request()->all(),[
            "post_id"=>['required'],
            "comment"=>['required'],

        ]);

        if($validator->fails()){
            return response()->json([
                "message"=>"Unprocessable",
                "error"=>$validator->errors()
            ]);
        }

        $comment=Comment::create([
            "user_id"=>auth()->user()->id,
            "post_id"=>$request->post_id,
            "comment"=>$request->comment
        ]);

        return response()->json([
            "message"=>"Comment created successfully",
            "data"=>$comment
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment,$id)
    {
        $comment = Comment::with('user')->where('id',$id)->first();
        return response()->json([
            "data"=>$comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
