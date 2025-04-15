<?php

namespace App\Http\Controllers;

use App\DTO\OrderCreateDTO;
use App\Http\Requests\HandleCheckoutOrderRequest;
use App\Models\User;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;

class OrderController
{
    private $cartService;
    private $orderService;
    public function __construct()
    {
        $this->cartService = new CartService();
        $this->orderService = new OrderService();
    }
    public function getCheckoutForm()
    {
        /** @var User $user */
        $user = Auth::user();
        $userProducts = $user->userProducts()->get();
        if(empty($userProducts))
        {
            return response()->redirectTo('/catalog');
        }
        $total = $this->cartService->getSum($user);
        return view('orderForm', compact('user', 'userProducts', 'total'));
    }
    public function handleCheckout(HandleCheckoutOrderRequest $request)
    {
        $data = $request->validated();
        $dto = new OrderCreateDTO(
            $data['contact_name'],
            $data['contact_phone'],
            $data['comment'],
            $data['address'],
        );
        $this->orderService->create($dto);
        return response()->redirectTo('/user-orders');
    }

    public function getAll()
    {
        $user = Auth::user();

        $orders = $user->orders()->with('products')->get();

        return view('userOrders', compact('orders'));
    }
}
