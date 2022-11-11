<?php

use App\Http\Controllers\CaptchasController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\TranslationsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/', [TopicsController::class, 'index'])->name('root');
Route::get('topics', [TopicsController::class, 'index'])->name('topics.index');
Route::get('topics/{topic}/{slug?}', [TopicsController::class, 'show'])->name('topics.show');
Route::get('categories/{category}', [CategoriesController::class, 'show'])->name('categories.show');
Route::resource('translates', TranslationsController::class);
Route::resource('captchas', CaptchasController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::resource('topics', TopicsController::class)->only(['create', 'store', 'update', 'edit', 'destroy']);
    Route::get('users/{user}/topics', [TopicsController::class, 'userIndex'])->name('users.topics.index');
    Route::post('upload_image', [TopicsController::class, 'uploadImage'])->name('topics.upload_image');
    Route::get('users/{user}/replies', [RepliesController::class, 'userIndex'])->name('users.replies.index');
    Route::resource('replies', RepliesController::class);
    Route::resource('notifications', NotificationsController::class);
});
