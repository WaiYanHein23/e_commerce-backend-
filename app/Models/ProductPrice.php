<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    //
    protected $table = 'product_prices';
    protected $fillable = ['product_id', 'grade_id', 'price'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function grade(){
        return $this->belongsTo(Grade::class);
    }
}
