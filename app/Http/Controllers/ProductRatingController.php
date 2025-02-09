<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductRating;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $ratings = $product->ratings()
            ->with('user:id,name')
            ->latest()
            ->paginate(10);

        return response()->json([
            'data' => $ratings,
            'average_rating' => $product->ratings()->avg('rating')
        ]);
    }

    /**
     * Cek apakah user sudah memberikan rating untuk produk tertentu.
     */
    public function checkRating(Product $product)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $rating = ProductRating::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        return response()->json([
            'hasRated' => !is_null($rating),
            'rating' => $rating ? $rating->rating : null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'rating' => 'required|integer|min:1|max:6'
            ]);

            // Cek apakah user sudah memberikan rating sebelumnya
            $existingRating = ProductRating::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->first();

            if ($existingRating) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You have given a rating for this product previously'
                ], 400);
            }

            // Buat rating baru
            $rating = ProductRating::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'rating' => $request->rating
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Rating successfully saved',
                'data' => $rating
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while saving the rating'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductRating $rating)
    {
        if (Auth::id() !== $rating->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $rating->delete();
        return response()->json(['message' => 'Rating deleted successfully']);
    }
}
