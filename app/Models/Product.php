<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $price
 * @property string $image_url
 * @property int $amount
 * @property float $rating
 * @property int $count
 */

class Product extends Model
{
    protected $fillable = ['id', 'name', 'description', 'price', 'image_url', 'amount', 'rating','count'];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function orders()
    {
        return $this->hasManyThrough(
            Order::class,
            OrderProduct::class,
            'product_id',
            'id',
            'id',
            'order_id',
        );
    }
    public function userProducts()
    {
        return $this->hasMany(UserProduct::class);
    }
    public function userProduct(User $user)
    {
        return $this->userProducts()->where('user_id', $user->id);
    }
    public function getAmountInCart(User $user)
    {
        return $this->userProduct($user)->first()->amount ?? 0;
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

}
