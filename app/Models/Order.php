<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $contact_name
 * @property string $contact_phone
 * @property string $comment
 * @property string $address
 * @property int $sum
 * @property string $yougile_task_id
 */
class Order extends Model
{
    protected $fillable = ['id', 'user_id', 'contact_name', 'contact_phone', 'comment', 'address', 'sum', 'yougile_task_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            OrderProduct::class,
            'order_id',
            'id',
            'id',
            'product_id'
        );
    }
    public function sum(): int
    {
        $total = 0;
        foreach ($this->orderProducts()->get() as $orderProduct) {
            $total += $orderProduct->sum();
        }
        return $total;
    }
}
