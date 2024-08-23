<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['category', 'brand', 'material', 'unit', 'productColors'];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function productColors()
    {
        return $this->belongsToMany(Color::class, 'product_colors');
    }

    public function productSizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeFilter(Builder $query)
    {
        $query->where('name', 'like', '%' . request('search') . '%');
    }
}
