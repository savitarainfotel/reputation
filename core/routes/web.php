<?php

use App\Http\Controllers\IntegrationsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\PlatformsController;

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
        Route::get('add-platforms/{property}', 'addPlatforms')->name('add.platforms');
        Route::match(['get', 'post'], 'infos/{property}', 'infos')->name('infos');
        Route::match(['get', 'post'], 'signature/{property}', 'addSignature')->name('add.signature');
    });

    Route::controller(PlatformsController::class)->name('platforms.')->prefix('platforms')->group(function () {
        Route::get('search/{property}/{platform}', 'search')->name('search');
        Route::match(['get', 'post'], 'add/{property}/{platform?}', 'addOrUpdate')->name('create');
    });

    Route::controller(IntegrationsController::class)->name('integrations.')->prefix('integrations')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('google/{ratingSetting}', 'google')->name('google');
        Route::get('google-callback', 'googleCallback')->name('google.callback');
    });
});

require __DIR__.'/auth.php';