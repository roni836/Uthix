<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $guarded=[];
    public function category()
    {
        return $this->belongsTo(Category::class);
    } 
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    public function images()
{
    return $this->hasMany(ProductImage::class, 'product_id');
}
public function firstImage()
{
    return $this->hasOne(ProductImage::class)->orderBy('id');
}
}
