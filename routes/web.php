<?php

use App\Http\Controllers\AuditController;
use App\Http\Controllers\ClientController;
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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->withoutMiddleware(['auth']);
Route::resource('client', ClientController::class);
Route::resource('audit', AuditController::class);
Route::get('assessment', [AuditController::class, 'assessment'])->name('audit.assessment');
Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index')->withoutMiddleware(['auth']);
