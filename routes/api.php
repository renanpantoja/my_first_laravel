<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\JobController;

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

Route::prefix('v1')->group(function () {
    Route::get('/jobs', [JobController::class, 'index']);
});

Route::get('v1/jobs/docs', function () {
    return view('api.jobs-docs');
});