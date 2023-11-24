<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\SocialController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('social/{service}/connect', [SocialController::class, 'connect'])->name('social.connect');

    Route::controller(EmailController::class)
        ->prefix('email')
        ->name('email.')
        ->middleware('MsGraphAuthenticated')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });
});
