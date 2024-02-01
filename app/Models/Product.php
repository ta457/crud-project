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
        if ($this->img === null) {
            return 'default.png';
        }

        return '/images/products/' . $this->img;
    }

    public function scopePriceHigherThan($query, $price)
    {
        return $query->where('price', '>', $price);
    }

    public function scopeSearch($query, $keyword, $categoryId)
    {
        if ($categoryId == 0) {
            return $query->where('name', 'like', '%' . $keyword . '%');
        }

        return $query->where('name', 'like', '%' . $keyword . '%')
            ->where('sub_category_id', $categoryId);
    }
}
