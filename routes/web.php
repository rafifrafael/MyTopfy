<?php

use App\Http\Controllers\SpotifyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/redirect', [SpotifyController::class, 'redirect']);
Route::get('/callback', [SpotifyController::class, 'callback']);
Route::get('/me', [SpotifyController::class, 'mytop']);

