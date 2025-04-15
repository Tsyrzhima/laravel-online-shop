<?php

namespace App\Http\Controllers;

use App\DTO\AddProductToCartDTO;
use App\DTO\DecreaceProductFromCartDTO;
use App\Models\User;
use App\Http\Requests\AddProductToCartRequest;
use App\Http\Requests\DecreaseProductFromCartRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\CartService;

class CartController
{
    private CartService $cartService;
    public function __construct()
    {
        $this->cartService = new CartService();
    }
    public function getCart()
    {
        /** @var User $user */
        $user = Auth::user();
        $userProducts = $user->userProducts()->get();
        return view('cart', compact('userProducts'));
    }
    public function addProductToCart(AddProductToCartRequest $request)
    {
        $data = $request->validated();
        $dto = new AddProductToCartDto($data['product_id'], $data['amount']);
        $amount = $this->cartService->addProduct($dto);
        $result = [
            'amount' => $amount
        ];
        echo json_encode($result);
    }
    public function decreaseProductFromCart(DecreaseProductFromCartRequest $request)
    {
        $data = $request->validated();
        $dto = new DecreaceProductFromCartDTO($data['product_id'], $data['amount']);
        $amount = $this->cartService->decreaseProduct($dto);
        $result = [
            'amount' => $amount
        ];
        echo json_encode($result);
    }

}
