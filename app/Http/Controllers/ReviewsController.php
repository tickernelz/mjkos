<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $review = Review::create([
            'kos_id' => $request->kos_id,
            'user_id' => $request->user_id,
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        if ($review) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }

    public function show(Review $review)
    {
    }

    public function edit(Review $review)
    {
    }

    public function update(Request $request, Review $review)
    {
    }

    public function destroy(Review $review)
    {
    }
}
