<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiMinecraftController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/', [ApiMinecraftController::class, 'index']);
Route::get('/server/bedrock', [ApiMinecraftController::class, 'bedrock']);
Route::get('/server/java', [ApiMinecraftController::class, 'java']);

Route::get('/voters', [ApiMinecraftController::class, 'voter']);

Route::get('/server/rcon', [ApiMinecraftController::class, 'rcon']);
Route::post('/server/rcon', [ApiMinecraftController::class, 'rconPost']);
