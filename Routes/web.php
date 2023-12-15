<?php

use Creode\LaravelNovaEvents\Http\Controllers\EventsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('events')->group(function () {
    Route::get('/', [EventsController::class, 'index']);

    Route::get('/{eventCategory:slug}', [EventsController::class, 'categoryShow'])
        ->name('events.category.show');

    Route::get('/{eventCategory:slug}/{eventSubCategory:slug}', [EventsController::class, 'subCategoryShow'])
        ->name('events.sub_category.show')
        ->scopeBindings();
});
