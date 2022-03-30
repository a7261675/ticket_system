<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\BugListController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('animal', 'App\Http\Controllers\AnimalController');



Route::prefix("animal")->group(function () {
    Route::get('/add', [AnimalController::class, 'add']);
});



Route::prefix("bug_list")->group(function () {
    Route::post('/add', [BugListController::class, 'addBugList']);
    Route::post('/modify', [BugListController::class, 'modifyBugList']);
    Route::delete('/delete', [BugListController::class, 'deleteBugList']);
    Route::post('/solve', [BugListController::class, 'solveBugList']);
    Route::get('/get', [BugListController::class, 'getBugList']);
});



