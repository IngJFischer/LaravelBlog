<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;


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

//El orden de las rutas importa. Si se sobreescribe el formato de ruta, se tiene en cuenta el orden.

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function (){
    Route::get('category/all', [CategoryController::class, 'all']);
    Route::get('category/slug/{slug}', [CategoryController::class, 'slug']);
    Route::get('category/{category}/posts', [CategoryController::class, 'posts']);
    Route::post('post/upload/{post}', [PostController::class, 'upload']);
    
    Route::get('post/all', [PostController::class, 'all']);
    Route::get('post/slug/{post:slug}', [PostController::class, 'slug']);
    
    Route::resource('category', CategoryController::class)->except(['create','edit']);
    Route::resource('post', PostController::class)->except(['create', 'edit']);
    
});

Route::post('user/login', [UserController::class, 'login']);
Route::post('user/logout', [UserController::class, 'logout']);
Route::post('user/checktoken', [UserController::class, 'checkToken']);


