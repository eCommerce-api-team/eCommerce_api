<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = 
    [
           'product_id',
            'sku',
            'price',
            'stock',
            'color',
            'size',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function scopeFilter($query , $request = null)
    {
        $query->when($request?->product , function ($q) use ($request){
            $q->whereHas('product' , function ($productQuery) use ($request){
                $productQuery->where('name' , 'like' , '%' . $request->product .'%');
            });
        });

        $query->when($request?->color , function ($q) use ($request){
            $q->where('color' , $request->color);
        });

        $query->when($request?->size , function ($q) use ($request){
            $q->where('size' , '=' , $request->size);
        });

        $query->when($request?->price , function ($q) use ($request){
            $q->where('price' , '=' , $request->price);
        });
    } 
}
