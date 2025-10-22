<?php

use App\Http\Controllers\ManagerSpinController;
use App\Http\Controllers\SpinController;
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

Route::resource('manager-spins', ManagerSpinController::class);

Route::post('/post-spin',[SpinController::class,'postSpin'])->name('post.spin');
Route::get('/',[SpinController::class,'index'])->name('spin');
// Route::resource('spin', SpinController::class);
