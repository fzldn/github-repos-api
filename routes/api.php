<?php

use App\Http\Controllers\Api\GithubRepoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/php', [GithubRepoController::class, 'php']);
Route::get('/popularity/php', [GithubRepoController::class, 'popularity']);
Route::get('/activity/php', [GithubRepoController::class, 'activity']);
