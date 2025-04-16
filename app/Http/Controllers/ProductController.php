<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddReviewRequest;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Services\ProductCacheService;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ProductController
{
    public function getCatalog()
    {
        /** @var  User $user */
        $user = Auth::user();
        $products = Cache::remember('products_all', 3600, function () {
            return Product::all();
        });
        //$products = Product::all();

        return view('catalog', ['products' => $products], compact('products'));
    }

    public function getProduct(int $id)
    {
        $product = Cache::remember("product_{$id}", 3600, function () use ($id) {
            return Product::find($id);
        });
        //$product = Product::find($id);
        $reviews = $product->reviews()->get();
        $sumReviews = 0;
        $count = count($reviews);
        foreach ($reviews as $review) {
            $sumReviews += $review->grade;
        }
        if($count > 0){
            $product->setAttribute('rating', $sumReviews/$count);
            $product->setAttribute('count', $count);
        }
        return view('product', ['product' => $product, 'reviews' => $reviews, 'count' => $count], compact('product'));
    }

    public function addReview(AddReviewRequest $request)
    {
        $productId = $request->input('product_id');
        $date = date("Y-m-d");
        $grade = $request->input('rating');
        $comment = $request->input('comment');
        Review::query()->create([
            'product_id' => $productId,
            'user_id' => Auth::id(),
            'date' => $date,
            'grade' => $grade,
            'comment' => $comment,
        ]);
        Cache::forget("product_{$productId}");
        return response()->redirectTo('/product/'.$productId);
    }
}
