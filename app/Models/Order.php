<?php

namespace App\Models;

use App\Models\OrderItem;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'restaurant_id',
        'total_price',
        'reserved_at',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTotalAttribute(): int
    {
        return $this->orderItems->sum(fn($item) => $item->price * $item->quantity);
    }


    public function updateTotalPrice()
    {
        $total = $this->orderItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $this->total_price = $total;
        $this->save();
    }
}
