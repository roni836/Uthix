<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    protected $fillable = [
        'cat_title',
        'cat_slug',
        'cat_description',
        'parent_category_id',
        'cat_image',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
   // Define relationship for Parent Category
  

   // Define relationship for Child Categories
   public function children()
   {
       return $this->hasMany(Category::class, 'parent_category_id');
   }

}
