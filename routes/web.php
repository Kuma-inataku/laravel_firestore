<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirestoreController;
use App\Http\Controllers\IndexController;

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
Route::get('/firestore', [IndexController::class, 'index']);

// API
Route::group(['prefix' => 'api', 'as' => 'api.'], function() {
    Route::get('/firestore', [FirestoreController::class, 'load']);
    Route::post('/firestore-store', [FirestoreController::class, 'store']);
    Route::post('/firestore-update', [FirestoreController::class, 'update']);
});
