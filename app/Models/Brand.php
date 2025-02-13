<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    protected $fillable=['name','status'];

    public function product(){
        return $this->belongs(Product::class);

    }



}
