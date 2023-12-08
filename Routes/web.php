<?php

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

use Modules\Events\Entities\EventCategory;
use Modules\Events\Entities\EventSubCategory;

Route::prefix('events')->group(function() {
    Route::get('/', 'EventsController@index');

    Route::get('/{eventCategory:slug}', 'EventsController@categoryShow')
        ->name('events.category.show');

    Route::get('/{eventCategory:slug}/{eventSubCategory:slug}', 'EventsController@subCategoryShow')
        ->name('events.sub_category.show')
        ->scopeBindings();
});
