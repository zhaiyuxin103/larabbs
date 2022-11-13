<?php

use App\Http\Controllers\Api\AuthorizationsController;
use App\Http\Controllers\Api\CaptchasController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\VerificationCodesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')
    ->name('api.v1.')
    ->group(function () {
        Route::middleware('throttle:'.config('api.rate_limits.sign'))
            ->group(function () {
                // 游客可以访问的接口

                // 图片验证码
                Route::apiResource('captchas', CaptchasController::class);
                // 短信验证码
                Route::apiResource('verification-codes', VerificationCodesController::class);
                // 用户注册
                Route::post('users', [UsersController::class, 'store'])->name('users.store');
                // 第三方登录
                Route::post('socials/{social_type}/authorizations', [AuthorizationsController::class, 'socialStore'])
                    ->where('social_type', 'wechat')
                    ->name('socials.authorizations.store');
                // 登录
                Route::post('authorizations', [AuthorizationsController::class, 'store'])->name('authorizations.store');
                // 刷新 token
                Route::put('authorizations/current', [AuthorizationsController::class, 'update'])->name('authorizations.update');

                // 登录后可以访问的接口
                Route::middleware(['auth:api'])->group(function () {
                    // 删除 token
                    Route::delete('authorizations/current', [AuthorizationsController::class, 'destroy'])->name('authorizations.destroy');
                });
            });

        Route::middleware('throttle:'.config('api.rate_limits.access'))
            ->group(function () {
            });
    });
