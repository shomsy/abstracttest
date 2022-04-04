<?php

use App\Http\Controllers\Auth\GitHubAuthController;
use App\Http\Controllers\GitCommitsController;
use App\Http\Controllers\GitRepositoriesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => 'auth'], static function () {
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put(
        'profile/password',
        ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']
    );
    Route::get('repositories', [GitRepositoriesController::class, '__invoke'])->name('repos');
    Route::get('repos/{owner}/{repo}/commits', [GitCommitsController::class, '__invoke'])->name('commits');
    Route::fallback(static function () {
       return redirect('/profile');
    });
});

Route::get('auth/github', [GitHubAuthController::class, 'gitRedirect'])->name('github.signup');
Route::get('auth/github/callback', [GitHubAuthController::class, 'gitCallback']);
Route::get('auth/github/logout', [GitHubAuthController::class, 'logout'])->name('github.logout');
