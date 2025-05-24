<?php

use App\Http\Controllers\AIController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageStepController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\StepController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/tanya-ai', [HomeController::class, 'tanyaAI'])->name('tanya-ai');
Route::get('/menu', [HomeController::class, 'menu'])->name('menu');
Route::post('/tanya-ai', [AIController::class, 'ask'])->name('ai.ask');


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::prefix('recipes')->group(function () {
        Route::get('/', [RecipeController::class, 'index'])->name('admin.recipes.index');
        Route::get('/create', [RecipeController::class, 'create'])->name('admin.recipes.create');
        Route::post('/store', [RecipeController::class, 'store'])->name('admin.recipes.store');
        Route::get('/edit/{id}', [RecipeController::class, 'edit'])->name('admin.recipes.edit');
        Route::post('/update/{id}', [RecipeController::class, 'update'])->name('admin.recipes.update');
        Route::delete('/delete/{id}', [RecipeController::class, 'destroy'])->name('admin.recipes.destroy');
        Route::prefix('steps')->group(function () {
            Route::get('/{slug}', [StepController::class, 'index'])->name('admin.recipes.steps.index');
            Route::get('/{slug}/create', [StepController::class, 'create'])->name('admin.recipes.steps.create');
            Route::post('/{slug}/store', [StepController::class, 'store'])->name('admin.recipes.steps.store');
            Route::get('/edit/{id}', [StepController::class, 'edit'])->name('admin.recipes.steps.edit');
            Route::post('/update/{id}', [StepController::class, 'update'])->name('admin.recipes.steps.update');
            Route::delete('/delete/{id}', [StepController::class, 'destroy'])->name('admin.recipes.steps.destroy');
            Route::prefix('/{id}/images')->group(function () {
                Route::get('/', [ImageStepController::class, 'index'])->name('admin.recipes.steps.images.index');
                Route::get('/create', [ImageStepController::class, 'create'])->name('admin.recipes.steps.images.create');
                Route::post('/store', [ImageStepController::class, 'store'])->name('admin.recipes.steps.images.store');
                Route::delete('/delete', [ImageStepController::class, 'destroy'])->name('admin.recipes.steps.images.destroy');
            });
        });
        Route::prefix('ingredients')->group(function () {
            Route::get('/{slug}', [IngredientController::class, 'index'])->name('admin.recipes.ingredients.index');
            Route::get('/create/{id}', [IngredientController::class, 'create'])->name('admin.recipes.ingredients.create');
            Route::post('/store/{id}', [IngredientController::class, 'store'])->name('admin.recipes.ingredients.store');
            Route::get('/edit/{id}', [IngredientController::class, 'edit'])->name('admin.recipes.ingredients.edit');
            Route::post('/update/{id}', [IngredientController::class, 'update'])->name('admin.recipes.ingredients.update');
            Route::delete('/delete/{id}', [IngredientController::class, 'destroy'])->name('admin.recipes.ingredients.destroy');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        $favoriteRecipes = $user->favoriteRecipes->map(function ($recipe) {
            return collect($recipe)->only(['title', 'slug', 'image']);
        });
        return view('user.dashboard', compact('favoriteRecipes'));
    })->name('user.dashboard');
    Route::post('/recipe-save/{slug}', [FavoriteController::class, 'save'])->name('recipe.save');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::get('/{slug}', [HomeController::class, 'showRecipe'])->name('recipe.show');
