<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Recipes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RecipeController extends Controller
{
    //
    public function index()
    {
        $recipes = Recipe::all();
        return view('admin.recipes.index', compact('recipes'));
    }

    public function create()
    {
        return view('admin.recipes.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $slug = Str::slug($request->title, '-');

        if (Recipe::where('slug', $slug)->exists()) {
            return redirect()->back()->withErrors('slug', 'Title already exists')->withInput();
        }

        if ($request->hasFile('image')) {
            try {
                //code...
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                Storage::disk('public')->put("thumbnail/" . $imageName, file_get_contents($image));
            } catch (\Throwable $th) {
                //throw $th;
                return redirect()->back()->withErrors('upload', 'Failed to upload image')->withInput();
            }
        }

        Recipe::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'video' => $request->video,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.recipes.index');
    }

    public function edit($slug)
    {
        $recipe = Recipe::where('slug', $slug)->first();
        return view('admin.recipes.edit', compact('recipe'));
    }

    public function update(Request $request, $slug)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $recipe = Recipe::where('slug', $slug)->first();

        if ($request->title != $recipe->title) {
            $slug = Str::slug($request->title, '-');
            if (Recipe::where('slug', $slug)->exists()) {
                return redirect()->back()->withErrors('slug', 'Title already exists')->withInput();
            } else {
                $recipe->slug = $slug;
            }
        }

        if ($request->hasFile('image')) {
            try {
                //code...
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                Storage::disk('public')->put("thumbnail/" . $imageName, file_get_contents($image));
                Storage::disk('public')->delete("thumbnail/" . $recipe->image);
                $recipe->image = $imageName;
            } catch (\Throwable $th) {
                //throw $th;
                return redirect()->back()->withErrors('upload', 'Failed to upload image')->withInput();
            }
        }

        $recipe->title = $request->title;
        $recipe->description = $request->description;
        $recipe->video = $request->video;
        $recipe->save();

        return redirect()->route('admin.recipes.index');
    }
}
