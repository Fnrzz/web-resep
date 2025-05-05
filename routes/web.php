<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\StepController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

Route::prefix('admin')->middleware('auth')->group(function () {
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
            Route::get('/create/{id}', [StepController::class, 'create'])->name('admin.recipes.steps.create');
            Route::post('/store/{id}', [StepController::class, 'store'])->name('admin.recipes.steps.store');
            Route::get('/edit/{id}', [StepController::class, 'edit'])->name('admin.recipes.steps.edit');
            Route::post('/update/{id}', [StepController::class, 'update'])->name('admin.recipes.steps.update');
            Route::delete('/delete/{id}', [StepController::class, 'destroy'])->name('admin.recipes.steps.destroy');
        });
        Route::prefix('ingredients')->group(function () {
            Route::get('/{slug}', [StepController::class, 'index'])->name('admin.recipes.ingredients.index');
            Route::get('/create/{id}', [StepController::class, 'create'])->name('admin.recipes.ingredients.create');
            Route::post('/store/{id}', [StepController::class, 'store'])->name('admin.recipes.ingredients.store');
            Route::get('/edit/{id}', [StepController::class, 'edit'])->name('admin.recipes.ingredients.edit');
            Route::post('/update/{id}', [StepController::class, 'update'])->name('admin.recipes.ingredients.update');
            Route::delete('/delete/{id}', [StepController::class, 'destroy'])->name('admin.recipes.ingredients.destroy');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
