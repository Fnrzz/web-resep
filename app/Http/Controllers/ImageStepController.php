<?php

namespace App\Http\Controllers;

use App\Models\ImageStep;
use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ImageStepController extends Controller
{
    //
    public function index($id)
    {
        $images = ImageStep::where('step_id', $id)->get();
        $step = Step::with('recipe')->find($id);
        confirmDelete('Kamu yakin?', 'Kamu akan menghapus semua data');
        return view('admin.steps.step-images.index', compact('images', 'id', 'step'));
    }

    public function create($id)
    {
        return view('admin.steps.step-images.create', compact('id'));
    }

    public function store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', 'Failed to upload image');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            try {
                //code...
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                Storage::disk('public')->put("step-images/" . $imageName, file_get_contents($image));
            } catch (\Throwable $th) {
                //throw $th;
                Alert::error('Error', 'Failed to upload image');
                return redirect()->back()->withErrors('upload', 'Failed to upload image')->withInput();
            }
        }
        ImageStep::create([
            'step_id' => $id,
            'path' => $imageName,
        ]);
        Alert::success('Success', 'Image uploaded successfully');
        return redirect()->route('admin.recipes.steps.images.index', compact('id'));
    }

    public function destroy($id)
    {
        $image = ImageStep::find($id);
        Storage::disk('public')->delete('step-images/' . $image->path);
        $image->delete();
        Alert::success('Success', 'Image deleted successfully');
        return redirect()->back();
    }
}
