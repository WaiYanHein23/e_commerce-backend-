<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    //
    protected $table = 'grades';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function product_prices(){
        return $this->hasMany(ProductPrice::class);
    }

}
