<?php

use App\Services\Wikipedia;
use Illuminate\Support\Facades\Route;

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

Route::get('/test', function() {
  return Wikipedia::content('Donald');
});

Route::post('/search', 'WikipediaController@search')->name('search');
Route::post('/content', 'WikipediaController@content')->name('content');
Route::get('/{any}', 'HomeController@index')->where('any', '.*');
