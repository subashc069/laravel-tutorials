<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadsController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ProfilesController;
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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//require __DIR__.'/auth.php';

Route::get('/threads', [ThreadsController::class, 'index'])
    ->name('threads.index');

Route::get('/threads/create', [ThreadsController::class, 'create'])
    ->name('threads.create');

Route::get('/threads/{channel}/{thread}', [ThreadsController::class, 'show'])
    ->name('threads.show');

Route::post('/threads', [ThreadsController::class, 'store'])
    ->name('threads.store');

Route::delete(
    '/threads/{channel}/{thread}', 
    [ThreadsController::class, 'destroy']
)->name('threads.delete');

Route::get('/threads/{channel:slug}', [ThreadsController::class, 'index']);
//This is something to happen
//Route::resource('/threads', ThreadsController::class);
Route::post('/threads/{channel}/{thread}/replies', [
	RepliesController::class,
	'store'	
])->name('replies.store');

Route::post('/replies/{reply}/favorites', [
	FavoritesController::class,
	'store'	
])->name('favorites.store');

Route::get('/profiles/{user}', [ProfilesController::class, 'show'])
    ->name('profiles.show');



