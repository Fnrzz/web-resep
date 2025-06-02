<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class StepController extends Controller
{
    //
    public function index($slug)
    {
        $recipe = Recipe::where('slug', $slug)->first();
        $steps = Step::where('recipe_id', $recipe->id)->get();
        $title = $recipe->title;
        confirmDelete('Kamu yakin?', 'Kamu akan menghapus semua data');
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
            Alert::error('Error', 'Failed to create step');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $recipe = Recipe::where('slug', $slug)->first();
        Step::create([
            'recipe_id' => $recipe->id,
            'description' => $request->description
        ]);
        Alert::success('Success', 'Step created successfully');
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
            Alert::error('Error', 'Failed to update step');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $step = Step::with('recipe')->find($id);
        $step->description = $request->description;
        $step->save();
        $slug = $step->recipe->slug;
        Alert::success('Success', 'Step updated successfully');
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
        Alert::success('Success', 'Step deleted successfully');
        return redirect()->back();
    }
}
