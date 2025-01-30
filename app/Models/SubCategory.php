<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';

    protected $fillable = ['name', 'slug', 'image', 'priority', 'cat_id']; // Ensure 'cat_id' is fillable

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id'); // Explicitly set foreign key
    }
    
}
