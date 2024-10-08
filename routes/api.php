<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post("/products", [ProductController::class, "createProduct"]);
Route::put("/products/{id}", [ProductController::class, "updateProduct"]);

Route::delete("/products/{id}", [ProductController::class, "deleteProduct"]);

Route::get("/products/{id}", [ProductController::class, "getProduct"]);
Route::get("/products", [ProductController::class, "getProducts"]);
