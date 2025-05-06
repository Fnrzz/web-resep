<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StepController extends Controller
{
    //
    public function index($slug)
    {
        $recipe = Recipe::where('slug', $slug)->first();
        $steps = Step::where('recipe_id', $recipe->id)->get();
        $title = $recipe->title;
        return view("admin.steps.index", compact('steps', 'slug', 'title'));
    }

    public function create($slug)
    {
        return view('admin.steps.create', compact('slug'));
    }

    public function store(Request $request, $slug)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $recipe = Recipe::where('slug', $slug)->first();
        Step::create([
            'recipe_id' => $recipe->id,
            'description' => $request->description
        ]);
        return redirect()->route('admin.recipes.steps.index', compact('slug'));
    }

    public function edit($id)
    {
        $step = Step::with('recipe')->find($id);
        return view('admin.steps.edit', compact('step'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $step = Step::with('recipe')->find($id);
        $step->description = $request->description;
        $step->save();
        $slug = $step->recipe->slug;
        return redirect()->route('admin.recipes.steps.index', compact('slug'));
    }

    public function destroy($id)
    {
        $step = Step::find($id);
        foreach ($step->images as $image) {
            Storage::disk('public')->delete('step-images/' . $image->path);
            $image->delete();
        }
        $step->delete();
        return redirect()->back();
    }
}
