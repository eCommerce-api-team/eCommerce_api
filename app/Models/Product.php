<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'category_id',
            'name',
            'slug',
            'stock',
            'description',
            'base_price',
        ];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imagable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeFilter($query , $request = null)
    {
        $query->when($request?->category , function ($q) use ($request) {
            $q->whereHas('category' , function ($categoryQuery) use ($request){
                $categoryQuery->where('name' , 'like' , '%' .$request->category.'%');
            });
        });
    }
}
