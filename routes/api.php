<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;

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

Route::get('/', function(){
    return response()->json([
        'status' => false,
        'message' => 'Unauthorized'
    ], 401);
})->name('login');

Route::post('register', [AuthController::class, 'Register']);
Route::post('login', [AuthController::class, 'Login']);


Route::middleware('auth:sanctum')->group(function() {
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/{category:slug}', [CategoryController::class, 'show']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::put('/category/{category:slug}', [CategoryController::class, 'update']);
    Route::delete('/category/{category:slug}', [CategoryController::class, 'destroy']);
});
