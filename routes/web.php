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
    $user_google = Socialite::driver('google')->stateless()->user();

    $user = User::updateOrCreate([
        'google_id' => $user_google->id,
    ],[
        'name' => $user_google->name,
        'email' => $user_google->email,
        'password' => Hash::make(Str::random(10)),
    ]);

    $user->assignRole('cliente');

    Auth::login($user);
    
    return redirect('/home');
});


//ADMIN ROUTES

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','role:super|admin|empleado'])->group(function () {
    Route::get('/home', function () {return view('home');})->name('inicio');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');


    //USUARIOS
    Route::get('/dashboard/usuarios', [UserController::class, 'index'])->name('user.index');
    Route::get('/dashboard/nuevo-usuario', [UserController::class, 'create'])->name('user.create');
    Route::post('/dashboard/crear-usuario', [UserController::class, 'store'])->name('user.store');
    Route::get('/dashboard/usuarios/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/dashboard/usuarios/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/dashboard/usuarios/delete/{user}', [UserController::class, 'delete'])->name('user.delete');
    Route::post('/dashboard/usuarios/restore/{user}', [UserController::class, 'restore'])->name('user.restore');

    //CLIENTES
    Route::get('/dashboard/clientes', [ClientController::class, 'index'])->name('client.index');
});
// Route::middleware(['auth','role:super|admin|empleado|cliente'])->group(function () {
//     // Route::get('/user/profile',[Auth])
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
//     Route::get('/user/profile', [DashboardController::class, 'userProfile'])->name('userProfile');
//     Route::get('/dashboard/usuarios', [UserController::class, 'index'])->name('user.index');

// });