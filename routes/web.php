<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndividuController;
use App\Http\Controllers\RefereeController;
use App\Http\Controllers\TeamController;
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
    Route::get('/create-teams', 'createTeams')->name('create-teams');
});

Route::get('/individu', [IndividuController::class, 'index'])->name('individu');
Route::get('/individu/active', [IndividuController::class, 'activeList'])->name('active');
Route::get('/showing', [IndividuController::class, 'showing'])->name('showing');

Route::get('/teams', [TeamController::class, 'index'])->name('team');

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::controller(RefereeController::class)->middleware('auth')->group(function () {
    Route::get('/judging', 'index')->name('judging');
    Route::get('/judging/{id}', 'show')->name('judging.show');
    Route::post('/judging', 'submit')->name('judging.submit');
});
