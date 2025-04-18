<?php

use App\Http\Controllers\AssistantController;
use App\Http\Controllers\ChatBotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use OpenAI\Laravel\Facades\OpenAI;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/chat', [ChatBotController::class, 'ask'])->name('chat.ask');

Route::post('/ask-assistant', [AssistantController::class, 'ask']);
