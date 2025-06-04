<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\JobController as ApiJobController;

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
Route::get('/healthcheck', function () {
    return response()->json(
        status: Response::HTTP_OK
    );
})->name('healthcheck');

Route::get('/', [JobController::class, 'index']);
Route::get('/employers', [EmployerController::class, 'index'])->name('employers.index');
Route::get('/employers/{employer:slug}/jobs', [EmployerController::class, 'jobs'])->name('employers.jobs');
Route::get('/jobs/salaries', [JobController::class, 'salaries'])->name('jobs.salaries');
Route::get('/jobs/salary/{salary}', [JobController::class, 'jobsBySalary'])->name('jobs.bySalary');

Route::get('/my-jobs', [JobController::class, 'myJobs'])->middleware('auth')->name('my-jobs');

Route::get('/jobs/create', [JobController::class, 'create'])->middleware('auth');
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');

Route::get('/search', SearchController::class);
Route::get('/tags/{tag:name}', TagController::class);

Route::middleware('auth')->group(function () {
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);

    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('/lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'pt'])) {
        abort(400);
    }

    session(['locale' => $locale]);
    app()->setLocale($locale);

    return back();
})->name('lang.switch');