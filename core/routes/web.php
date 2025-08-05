<?php

use App\Http\Controllers\IntegrationsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\PlatformsController;
use App\Http\Controllers\CompetitorsController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\SurveyController;
use App\Http\Middleware\RedirectIfNoPropertyAvailable;

Route::get('/', function () {
    return redirect()->route('reviews.index');
})->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('reviews.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(PropertiesController::class)->name('properties.')->prefix('properties')->group(function () {
        Route::match(['get', 'post'], 'add', 'addOrUpdate')->name('create');
    });

    Route::middleware('verify-property')->group(function () {
        Route::controller(PropertiesController::class)->name('properties.')->prefix('properties')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('add-platforms/{property}', 'addPlatforms')->name('add.platforms');
            Route::match(['get', 'post'], 'infos/{property}', 'infos')->name('infos');
            Route::match(['get', 'post'], 'signature/{property}', 'addSignature')->name('add.signature');
        });

        Route::controller(PlatformsController::class)->name('platforms.')->prefix('platforms')->group(function () {
            Route::get('search/{platform}', 'search')->name('search');
            Route::match(['get', 'post'], 'add-property/{property}/{platform?}', 'addProperty')->name('create.property');
            Route::match(['get', 'post'], 'add-competitor/{competitor}/{platform?}', 'addCompetitor')->name('create.competitor');
        });
    
        Route::controller(IntegrationsController::class)->name('integrations.')->prefix('integrations')->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('google/{ratingSetting}', 'google')->name('google');
            Route::get('google-callback', 'googleCallback')->name('google.callback');
        });
    
        Route::controller(CompetitorsController::class)->name('competitors.')->prefix('competitors')->group(function () {
            Route::get('{property?}', 'index')->name('index');
            Route::match(['get', 'post'], 'add/{property}', 'addOrUpdate')->name('create');
            Route::get('add-platforms/{competitor}', 'addPlatforms')->name('add.platforms');
            Route::match(['get', 'post'], 'infos/{competitor}', 'infos')->name('infos');
        });
    
        Route::controller(ReviewsController::class)->name('reviews.')->prefix('reviews')->group(function () {
            Route::get('{property?}', 'index')->name('index');
        });
    
        Route::controller(SurveyController::class)->name('survey.')->prefix('survey')->group(function () {
            Route::match(['get', 'post'], 'add/{survey?}', 'addOrUpdate')->name('create');
            Route::get('{property?}', 'index')->name('index');
            Route::get('report', 'report')->name('report');
        });
    });
});

require __DIR__.'/auth.php';