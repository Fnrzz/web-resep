<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Recipes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class RecipeController extends Controller
{
    //
    public function index()
    {
        $recipes = Recipe::all();
        confirmDelete('Kamu yakin?', 'Kamu akan menghapus semua data');
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
            Alert::error('Error', 'Failed to create recipe');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $slug = Str::slug($request->title, '-');

        if (Recipe::where('slug', $slug)->exists()) {
            Alert::error('Error', 'Title already exists');
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
                Alert::error('Error', 'Failed to upload image');
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

        Alert::success('Success', 'Recipe created successfully');
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
            Alert::error('Error', 'Failed to update recipe');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $recipe = Recipe::where('slug', $slug)->first();

        if ($request->title != $recipe->title) {
            $slug = Str::slug($request->title, '-');
            if (Recipe::where('slug', $slug)->exists()) {
                Alert::error('Error', 'Title already exists');
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
                Alert::error('Error', 'Failed to upload image');
                return redirect()->back()->withErrors('upload', 'Failed to upload image')->withInput();
            }
        }

        $recipe->title = $request->title;
        $recipe->description = $request->description;
        $recipe->video = $request->video;
        $recipe->save();

        Alert::success('Success', 'Recipe updated successfully');
        return redirect()->route('admin.recipes.index');
    }

    public function destroy($slug)
    {
        $recipe = Recipe::where('slug', $slug)->with(['ingredients', 'steps.images'])->first();
        Storage::disk('public')->delete("thumbnail/" . $recipe->image);

        foreach ($recipe->ingredients as $ingredient) {
            $ingredient->delete();
        }

        foreach ($recipe->steps as $step) {
            foreach ($step->images as $image) {
                Storage::disk('public')->delete('step-images/' . $image->path);
                $image->delete();
            }
            $step->delete();
        }
        $recipe->delete();

        Alert::success('Success', 'Recipe deleted successfully');
        return redirect()->route('admin.recipes.index');
    }
}
