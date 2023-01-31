<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Creamos rutas agrupadas bajo el prefijo dashboard
//('middleware'=>'auth' es para usar el esquema de validación).
Route::group(['prefix'=>'dashboard', 'middleware'=>'auth'], function () {

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

require __DIR__.'/auth.php';
