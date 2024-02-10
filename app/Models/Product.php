<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [ 'name','description','price','quantity','category_id' ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCategoryNameAttribute()
    {
        return $this->category->name;
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
            ->where('category_id', $categoryId);
    }
}
