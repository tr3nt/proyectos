<?php

use App\Livewire\NewProject;
use App\Livewire\ShowProjects;
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

// Home
Route::get('/', [ShowProjects::class, 'render']);
// Create project view
Route::get('new', [NewProject::class, 'render']);