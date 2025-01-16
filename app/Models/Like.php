<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $fillable = ['user_id', 'post_id'];

   //relation between user and like
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relation between post and like
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
