<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

        protected $fillable = ["name",'image_path','color_id','size_id','product_price_id','brand_id','category_id'];

        public function categories(){
            return $this->hasMany(Category::class);
        }

        public function brands(){
            return $this->hasMany(Brand::class);
        }

        public function sizes(){
            return $this->hasMany(Size::class);
        }

        public function colors(){
            return $this->hasMany(Color::class);
        }

        public function product_prices(){
            return $this->hasMany(ProductPrice::class);
        }
}
