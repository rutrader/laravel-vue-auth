<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\Companies\ManageController;

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

Route::get('/', [DefaultController::class, 'index'])->name('default');

Route::prefix('user')->group(function() {
	Route::get('/login', [UserAuthController::class, 'login'])->name('login');
	Route::post('/login-check', [UserAuthController::class, 'loginCheck'])->name('login-check');
	Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');
	
	Route::get('/registration', [RegistrationController::class, 'register'])->name('register');
	Route::post('/create', [RegistrationController::class, 'create']);
});

Route::prefix('company')->group(function() {
	Route::get('/manage', [ManageController::class, 'manage'])->name('company-manage');
	Route::post('/save', [ManageController::class, 'save'])->name('company-save');
});