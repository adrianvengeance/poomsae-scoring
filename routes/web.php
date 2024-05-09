<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndividuController;
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

Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'showHome')->name('home');
    Route::get('/data', 'showData')->name('data');
    Route::post('/upload', 'upload')->name('upload');
    Route::get('/history', 'showHistory')->name('history');
});

Route::get('/individu', [IndividuController::class, 'index'])->name('individu');

Route::get('/team', function () {
    return 'group';
})->name('team');
