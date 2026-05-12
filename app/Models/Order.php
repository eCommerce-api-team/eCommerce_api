<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
        'payment_status',
        'payment_method',
        'transaction_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function scopeFilter($query, $request = null)
    {
        $query->when($request?->user_id, function ($q) use ($request) {
            $q->whereHas('user', function ($userQuery) use ($request) {
                $userQuery->where('id', $request->user_id);
            });
        });

        return $query;
    }
}
