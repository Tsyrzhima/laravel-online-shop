<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $order_id
 * @property int $product_id
 * @property int $amount
 * @property int $sum
 * @property Product $product
 */
class OrderProduct extends Model
{
    protected $fillable = ['order_id', 'product_id', 'amount', 'sum', 'Product'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function sum()
    {
        return $this->amount * $this->product->price;
    }

}
