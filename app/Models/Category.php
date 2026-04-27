<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable =
        [

            'name',
            'slug',
            'description',

        ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function scopeFilter($query, $request = null)
    {
        $query->when($request?->name, function ($q) use ($request) {
            $q->where('name', 'like', '%'.$request->name.'%');
        });
    }
}
