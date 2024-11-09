<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use Modules\Gallery\Http\Controllers\Frontend\GalleriesController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/galleries', function (Request $request) {
//     return $request->user();
// });

// Route::get('/galleries', [ApiController::class, 'index_data_gallery']);
Route::get('/galleries', [GalleriesController::class, 'index_data_gallery'])->name('api.gallery');
