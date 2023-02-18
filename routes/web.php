<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Models\User;
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

//SOCIALITE OAuth
 
Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-auth/callback', function () {
    $user = Socialite::driver('google')->user();
    dd($user);
    // $user->token
});


//ADMIN ROUTES


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','role:super|admin|empleado|cliente'])->group(function () {
    Route::get('/home', function () {return view('home');})->name('inicio');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');


    //USUARIOS
    Route::get('/dashboard/usuarios', [UserController::class, 'index'])->name('user.index');
    Route::get('/dashboard/nuevo-usuario', [UserController::class, 'create'])->name('user.create');
    Route::post('/dashboard/crear-usuario', [UserController::class, 'store'])->name('user.store');
    Route::put('/dashboard/usuarios/edit', [UserController::class, 'edit'])->name('user.edit');


    //CLIENTES
    Route::get('/dashboard/clientes', [ClientController::class, 'index'])->name('client.index');
});
// Route::middleware(['auth','role:super|admin|empleado|cliente'])->group(function () {
//     // Route::get('/user/profile',[Auth])
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
//     Route::get('/user/profile', [DashboardController::class, 'userProfile'])->name('userProfile');
//     Route::get('/dashboard/usuarios', [UserController::class, 'index'])->name('user.index');

// });