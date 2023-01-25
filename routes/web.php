<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\CategoryController;


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


//Creamos rutas agrupadas bajo el prefijo dashboard.
Route::group(['prefix'=>'dashboard'], function () {
    
    //Creamos las rutas tipo recurso asociadas al controlador PostController.
    
    //La primer forma es la siguiente:
    //Route::resource('post', PostController::class);
    //Route::resource('category', CategoryController::class);

    //Una forma mas abreviada y agrupada es:
    Route::resources([
        'post' => PostController::class,
        'category' => CategoryController::class,
    ]);
});