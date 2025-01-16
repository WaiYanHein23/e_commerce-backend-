<?php

namespace App\Http\Resources;

use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class postResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'post_id'=>$this->id,
            'post_title'=>$this->title,
            'content'=>$this->content,
            'author_id'=>$this->user_id,
            'published_at'=>$this->created_at,
            'last_updated'=>$this->updated_at,
            'author_name'=>$this->user->name,
            'author_email'=>$this->user->email,
            "comment_count"=>Comment::where('post_id',operator: $this->id)->where('user_id',$this->id)->count(),
            "like_count"=>Like::where('post_id',operator: $this->id)->where('user_id',$this->id)->count(),
            "comments"=>Comment::where('post_id',$this->id)->get(),
            "likes"=>Like::where('post_id',$this->id)->get()

        ];
    }
}
