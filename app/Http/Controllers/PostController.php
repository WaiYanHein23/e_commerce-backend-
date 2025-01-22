<?php

namespace App\Http\Controllers;

use App\Http\Resources\postResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::all();

        return response()->json([
            "posts"=>$posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator=Validator::make(request()->all(),[
            "title"=>['required'],
            "content"=>['required']

        ]);

        if($validator->fails()){
            return response()->json([
                "message"=>"Unprocessable",
                "error"=>$validator->errors()
            ]);
        }

        $post=Post::create([
            "user_id"=>auth()->user()->id,
            "title"=>$request->title,
            "content"=>$request->content
        ]);

        return response()->json([
            "message"=>"Post created successfully",
            "data"=>$post
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Fetch the post with its related user, comments, and likes
        $post = Post::with('user', 'comments', 'likes')->find($id);

        // Check if the post exists
        if (!$post) {
            return response()->json([
                'message' => 'Post not found',
            ], 404);
        }

        // Transform the post data using the resource
        $post_data = new postResource($post);

        // Return the response as JSON
        return response()->json([
            'data' => $post_data,
        ]);
    }


    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validator=Validator::make(request()->all(),[
            "title"=>['required'],
            "content"=>['required']

        ]);

        if($validator->fails()){
            return response()->json([
                "message"=>"Unprocessable",
                "error"=>$validator->errors()
            ]);
        }

        $post->update(request()->all());

        return response()->json([
          "message"=>"Post updated successfully",
          "data"=>$post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            "message"=>"Post deleted successfully"
        ]);
    }
}
