<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = ["user_id", "post_id", "comment"];

    //relation between comment and post
    public function post(){
        return $this->belongsTo(Post::class);
    }

    //relation between comment and user
    public function user(){
        return $this->belongsTo(User::class);
    }
}
