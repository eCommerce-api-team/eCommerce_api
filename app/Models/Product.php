<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use app\Models\Image;
use app\Models\Category;
use app\Models\Variant;

class Product extends Model
{
     use HasFactory;

    protected $fillable = 
     [
       
        'category_id',
        'name',
        'slug',
        'description',
        'base_price',
    
    ];

public function images () :MorphMany 
{
    return $this->morphMany(Image::class,'imagable');
}  

public function category ()
{
    return $this->belongsTo(Category::class);
}

public function variants()
{
    return $this->hasMany(Variant::class);
} 

}
