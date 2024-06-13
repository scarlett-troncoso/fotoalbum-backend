<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Photo;
use App\Http\Controllers\API\PhotoController;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

/*
Route::get('photos', function(){
    return Photo::all();
});*/

Route::get('photos', [PhotoController::class, 'index']);

Route::get('photos/{photo}', [PhotoController::class, 'show']);

Route::get('categories', function(){
    return Category::all();
}); //http://127.0.0.1:8000/api/categories