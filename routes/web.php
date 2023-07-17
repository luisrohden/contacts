<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*** Auth ***/

//Login
Route::get('/login',[UserController::class,'login'])->name('login');
Route::post('/login',[UserController::class,'loginAction']);

//Register
Route::get('/register',[UserController::class,'register'])->name('register');
Route::post('/register',[UserController::class,'registerAction']);

//Logout
Route::get('/logout',[UserController::class,'logout']);

/*** Contact ***/

//Contact :: Register
Route::get('/contatos/cadastrar',[ContactController::class,'register']);
Route::post('/contatos/cadastrar',[ContactController::class,'registerAction']);
//
Route::get('/contatos/editar/{contact_id}',[ContactController::class,'edit']);
Route::post('/contatos/editar/{contact_id}',[ContactController::class,'editAction']);
//
Route::get('/contatos/excluir/{contact_id}',[ContactController::class,'delete']);
Route::post('/contatos/excluir/{contact_id}',[ContactController::class,'deleteAction']);




//Home
Route::get('/',[ContactController::class,'index'])->name('home');





//Route::get('/',[ContactsController::class],'index');
//Route::get('/user/login',UserController::class,'login');
