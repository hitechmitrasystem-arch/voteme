<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminElectionController;
use App\Http\Controllers\Admin\AdminVoterController;
use App\Http\Controllers\Admin\AdminCandidateController;

/*
|--------------------------------------------------------------------------
| Voter Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Voter\AuthController as VoterAuthController;
use App\Http\Controllers\Voter\VoterDashboardController;
use App\Http\Controllers\Voter\VoteController;

/*
|--------------------------------------------------------------------------
| Home Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('auth.select-login');
})->name('home');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // Login Routes
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

    // Protected Admin Routes
    Route::middleware('auth:admin')->group(function () {

        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('elections', AdminElectionController::class);
        Route::post('elections/{id}/toggle', [AdminElectionController::class, 'toggle'])->name('elections.toggle');
        Route::post('elections/{id}/lock', [AdminElectionController::class, 'lock'])->name('elections.lock');
        Route::get('elections/{id}/results', [AdminElectionController::class, 'results'])->name('elections.results');

        Route::resource('voters', AdminVoterController::class);
        Route::resource('candidates', AdminCandidateController::class);
    });
});


/*
|--------------------------------------------------------------------------
| VOTER ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('voter')->name('voter.')->group(function () {

    // Login Routes
    Route::get('/login', [VoterAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [VoterAuthController::class, 'login'])->name('login.submit');

    // Protected Voter Routes
    Route::middleware('auth:voter')->group(function () {

        Route::post('/logout', [VoterAuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [VoterDashboardController::class, 'index'])->name('dashboard');

        // IMPORTANT: Vote is POST ONLY
        Route::post('/vote', [VoteController::class, 'store'])->name('vote');

        Route::get('/results/{id}', [VoteController::class, 'results'])->name('results');
    });
});