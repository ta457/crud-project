<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [ 'name','description','price','quantity','sub_category_id' ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function getCategoryNameAttribute()
    {
        return $this->subCategory->name;
    }

    public function getImagePathAttribute()
    {
        return '/images/products/' . $this->img;
    }

    public function scopePriceHigherThan($query, $price)
    {
        return $query->where('price', '>', $price);
    }
}
