<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/single', function () {
    return view('single');
});

Route::get('login', function () {
    return view('auth.login');
});

Route::get('signup', function () {
    return view('auth.signup');
});

route::post('login', [LoginController::class,'save']);
route::post('signup', [SignupController::class,'save']);

route::post('admin', [AdminController::class,'index'])->middleware('auth');
