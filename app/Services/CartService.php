<?php

namespace App\Services;

use App\DTO\AddProductToCartDTO;
use App\DTO\DecreaceProductFromCartDTO;
use App\Http\Requests\AddProductToCartRequest;
use App\Http\Requests\DecreaseProductFromCartRequest;
use App\Models\User;
use App\Models\UserProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function addProduct(AddProductToCartDTO $data): int
    {
        $userId = Auth::id();

        $userProduct = UserProduct::firstOrCreate([
            'user_id' => $userId,
            'product_id' => $data->getProductId()
        ], [
            'amount' => 0
        ]);

        $userProduct->increment('amount', $data->getAmount());

        $userProduct->save();

        return $userProduct->amount;
    }
    public function decreaseProduct(DecreaceProductFromCartDTO $data): int
    {
        $userId = Auth::id();
        $userProduct = UserProduct::where([
            'user_id' => $userId,
            'product_id' => $data->getProductId()
            ])->first();
        if ($userProduct) {
            if($userProduct->amount > 1){
                $amount = $userProduct->decrement('amount', $data->getAmount());
                $userProduct->save();
            }elseif($userProduct->amount === 1){
                $amount = 0;
                $userProduct->delete();
            }
        }else{
            $amount = 0;
        }
        return $amount;
    }
    public function getSum(User $user): int
    {
        $total = 0;
        foreach ($user->userProducts()->get() as $userProduct) {
            $total += $userProduct->sum();
        }
        return $total;
    }

}
