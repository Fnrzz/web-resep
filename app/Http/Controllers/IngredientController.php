<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IngredientController extends Controller
{
    //
    public function index($slug)
    {
        $recipe = Recipe::where('slug', $slug)->first();
        $ingredients = Ingredient::where('recipe_id', $recipe->id)->get();
        $title = $recipe->title;
        return view('admin.ingredients.index', compact('ingredients', 'slug', 'title'));
    }

    public function create($slug)
    {
        return view('admin.ingredients.create', compact('slug'));
    }

    public function store(Request $request, $slug)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $recipe = Recipe::where('slug', $slug)->first();
        Ingredient::create([
            'recipe_id' => $recipe->id,
            'name' => $request->name,
            'amount' => $request->amount,
        ]);
        return redirect()->route('admin.recipes.ingredients.index', compact('slug'));
    }

    public function edit($id)
    {
        $ingredient = Ingredient::with('recipe')->find($id);
        return view('admin.ingredients.edit', compact('ingredient'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ingredient = Ingredient::with('recipe')->find($id);
        $ingredient->name = $request->name;
        $ingredient->amount = $request->amount;
        $ingredient->save();
        $slug = $ingredient->recipe->slug;
        return redirect()->route('admin.recipes.ingredients.index', compact('slug'));
    }

    public function destroy($id)
    {
        $ingredient = Ingredient::find($id);
        $slug = $ingredient->recipe->slug;
        $ingredient->delete();
        return redirect()->route('admin.recipes.ingredients.index', compact('slug'));
    }
}
