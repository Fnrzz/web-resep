<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class FavoriteController extends Controller
{
    //
    protected $ratingController;
    public function __construct(RatingController $ratingController)
    {
        $this->ratingController = $ratingController;
    }
    public function save(Request $request, $slug)
    {
        $request->validate([
            'rating' => 'integer|min:1|max:5',
        ]);

        $recipeId = Recipe::where('slug', $slug)->select('id')->firstOrFail();

        $userId = Auth::user()->id;

        if ($request->rating) {
            $addRating = $this->ratingController->addRating($recipeId->id, $request->rating, $userId);
            if (!$addRating) {
                Alert::error('Gagal', 'Gagal menambahkan rating');
                return back();
            }
        }

        Favorite::create([
            'user_id' => $userId,
            'recipe_id' => $recipeId->id
        ]);

        Alert::success('Berhasil', 'Berhasil menyimpan resep');
        return back();
    }

    public function unsave($slug)
    {
        $recipeId = Recipe::where('slug', $slug)->select('id')->firstOrFail();
        $userId = Auth::user()->id;
        Favorite::where('recipe_id', $recipeId->id)->where('user_id', $userId)->delete();
        Alert::success('Berhasil', 'Berhasil menghapus resep');
        return back();
    }
}
