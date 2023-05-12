<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthUserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('register',[AuthUserController::class,'register']);
    Route::post('login', [AuthUserController::class,'login'])->name('login');
    Route::post('logout',[AuthUserController::class,'logout']);
    Route::post('refresh',[AuthUserController::class,'refresh']);
    Route::post('me', [AuthUserController::class,'me']);

});


Route::group([

    'middleware' => ['role:administrator'],

], function ($router) {


});
