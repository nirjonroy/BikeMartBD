<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'categoryId',
        'subCategoryId',
        'childCategoryId',
        'shortDescription',
        'longDescription',
        'current_price',
        'old_price',
        'brand_id',
        'product_code',
        'image',
        'multi_image_id',
        'videoUrl',
        'stock_qty',
        'sold_qty',
        'weight',
        'color',
        'measurement',
        'seo_title',
        'seo_description',
        'tags',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'categoryId');
    }

    public function subCategory(){
        return $this->belongsTo(SubCategory::class, 'subCategoryId');
    }

    public function childCategory(){
        return $this->belongsTo(ChildCategory::class, 'childCategoryId');
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }
}
