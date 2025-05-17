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
}
