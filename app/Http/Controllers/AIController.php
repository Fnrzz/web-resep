<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    //
    public function ask(Request $request)
    {
        $question = $request->question;
        $getRecipes = Recipe::with('ingredients', 'steps')->get();
        $recipes = $getRecipes->map(function ($recipe) {
            return [
                'id' => $recipe->id,
                'name' => $recipe->title,
                'ingredients' => $recipe->ingredients->pluck('name')->toArray(),
                'steps' => $recipe->steps->pluck('description')->toArray(),
            ];
        });

        $prompt = "Berikut adalah daftar resep makanan dalam format JSON:\n\n" .
            json_encode($recipes, JSON_PRETTY_PRINT) .
            "\n\nPertanyaan: \"$question\"\n\n" .
            "Pilih resep yang paling sesuai dari daftar di atas.\n\n" .
            "Balas **dalam format JSON murni** TANPA teks tambahan, TANPA blok markdown. Format HARUS seperti ini:\n" .
            "{ \"id\": nomor_id_resep anda bisa menambahkan lebih dari 1 id resep dan id resep harus berbentuk array, \"alasan\": \"alasan kenapa resep tersebut paling cocok\" }\n\n" .
            "Jangan kosongkan field 'alasan'. Jawabanmu akan langsung dibaca oleh sistem backend.";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=' . env('GEMINI_API_KEY'), [
            'contents' => [[
                'parts' => [['text' => $prompt]]
            ]]
        ]);

        $data = $response->json();

        $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

        $cleaned = preg_replace('/^```json|```$/m', '', trim($text));

        $cleaned = trim($cleaned);

        $output = json_decode($cleaned, true);

        $outputRecipe = Recipe::whereIn('id', $output['id'])->get();
        $reason = $output['alasan'];

        return view('ai-menu', compact('outputRecipe', 'reason'));
    }
}
