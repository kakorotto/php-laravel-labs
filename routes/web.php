<?php

use App\Http\Controllers\PostController;  //require
use App\Http\Controllers\CreateFormController;  //require
use Illuminate\Support\Facades\Route;


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
// Route::get('/test', function () {
//     $name="pola";
//     return view('test',[
//         'name' => $name,
//     ]);
// });

Route::get('/form', function () {
    return view('form');
});
Route::get("/posts",[PostController::class, "index"]);
Route::get("/posts/create",[PostController::class, 'create']);
Route::post("/posts/store",[PostController::class, 'store']);
Route::get("/posts/{post}",[PostController::class, 'show']);
Route::get("/posts/{post}/edit",[PostController::class,'edit']);
// Route::patch("/posts/{post}",[PostController::class,'update'])->name('posts.update');
// Route::delete("/posts/{post}",[PostController::class,'destroy'])->name('posts.delete');
// Route::get('/create-form',[CreateFormController::class,'createForm']);
