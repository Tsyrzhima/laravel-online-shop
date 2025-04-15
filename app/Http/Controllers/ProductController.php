<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddReviewRequest;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProductController
{
    public function getCatalog()
    {
        /** @var  User $user */
        $user = Auth::user();
        $products = Product::all();

        return view('catalog', ['products' => $products]);
    }

    public function getProduct(int $id)
    {
        $product = Product::find($id);
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
        return view('product', ['product' => $product, 'reviews' => $reviews, 'count' => $count]);
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
        return response()->redirectTo('/product/'.$productId);
    }
}
