<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property int $product_id
 * @property int $amount
 * @property int $totalSum
 */
class UserProduct extends Model
{
    protected $fillable = ['user_id', 'product_id', 'amount', 'totalSum'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function sum()
    {
        return $this->amount * $this->product()->first()->price;
    }
}
