<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Project\Create;
use App\Livewire\Project\Index;
use App\Livewire\Project\Show;

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

// Protected routes
Route::middleware('auth')->group(function () {
    Route::prefix('projects')->group(function () {
        Route::get('/create', Create::class)->name('create');
        Route::get('/edit/{id}', Index::class)->name('project');
    });
});

// Public routes
Route::get('/', function () { return view('app'); })->name('home');
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

Route::prefix('projects')->group(function () {
    Route::get('/', Show::class)->name('show');
    Route::get('/{id}', Index::class)->name('project');
});