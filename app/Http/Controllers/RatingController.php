<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    //
    public function getRatingByRecipe($recipe_id)
    {
        $rating = Rating::where('recipe_id', $recipe_id)->avg('rating');
        return $rating ?? 0;
    }

    public function addRating($recipe_id, $rating, $user_id)
    {
        $rating = Rating::create([
            'user_id' => $user_id,
            'recipe_id' => $recipe_id,
            'rating' => $rating
        ]);
        if (!$rating) {
            return false;
        }
        return true;
    }
}
