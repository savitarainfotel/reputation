<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\PlatformsController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RatingReplyController;
use App\Http\Controllers\ReplyReviewController;
use App\Http\Controllers\ReportsController;

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(PropertiesController::class)->name('properties.')->prefix('properties')->group(function () {
        Route::get('', 'index')->name('index');
        Route::match(['get', 'post'], 'add', 'addOrUpdate')->name('create');
        Route::match(['get', 'post'], 'add-platforms/{property?}', 'addPlatforms')->name('add.platforms');
        Route::match(['get', 'post'], 'infos/{property?}', 'infos')->name('infos');
    });

    Route::controller(PlatformsController::class)->name('platforms.')->prefix('platforms')->group(function () {
        Route::get('search/{property}/{platform}', 'search')->name('search');
        Route::match(['get', 'post'], 'add/{property}/{platform?}', 'addOrUpdate')->name('create');
    });
    Route::controller(ReplyReviewController::class)->name('reply-review.')->prefix('reply-review')->group(function () {
        Route::get('', 'index')->name('index');
    });
    Route::controller(RatingReplyController::class)->name('rating-reply.')->prefix('rating-reply')->group(function () {
        Route::get('', 'index')->name('index');
    });
    Route::controller(ReportsController::class)->name('reports.')->prefix('reports')->group(function () {
        Route::get('', 'index')->name('index');
    });
    Route::controller(PropertyController::class)->name('property.')->prefix('property')->group(function () {
        Route::get('', 'index')->name('index');
    });
});

require __DIR__.'/auth.php';