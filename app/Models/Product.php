<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'size',
        'price',
        'stock',
        'image',
        'product_category_id',
        'is_carousel'
    ];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
