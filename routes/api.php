<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
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
Route::post('register',[AuthController::class, 'register']);
Route::post('login',[AuthController::class,'login']);
Route::get('view-profile/{email}',[UserController::class,'viewprofile']);
// Route::post('update-user/{email}',[UserController::class, 'updateprofile']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});