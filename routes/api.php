<?php

use App\Http\Controllers\Api\AuthorizationsController;
use App\Http\Controllers\Api\CaptchasController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ImagesController;
use App\Http\Controllers\Api\LinksController;
use App\Http\Controllers\Api\NotificationsController;
use App\Http\Controllers\Api\PermissionsController;
use App\Http\Controllers\Api\RepliesController;
use App\Http\Controllers\Api\TopicsController;
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
    ->middleware('change-locale')
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
                // 游客可以访问的接口

                // 某个用户的详情
                Route::apiResource('users', UsersController::class);
                // 分类列表
                Route::apiResource('categories', CategoriesController::class)->only(['index']);
                // 某个用户发布的话题
                Route::get('users/{user}/topics', [TopicsController::class, 'userIndex'])->name('users.topics.index');
                // 话题列表、详情
                Route::apiResource('topics', TopicsController::class)->only(['index', 'show']);
                // 话题回复列表
                Route::apiResource('topics.replies', RepliesController::class)->only(['index']);
                // 某个用户的回复列表
                Route::get('users/{user}/replies', [RepliesController::class, 'userIndex'])->name('users.replies.index');
                // 资源推荐
                Route::apiResource('links', LinksController::class)->only(['index']);
                // 活跃用户
                Route::get('actived/users', [UsersController::class, 'activedIndex'])->name('actived.users.index');

                // 登录后可以访问的接口
                Route::middleware(['auth:api'])->group(function () {
                    // 当前登录用户信息
                    Route::get('user', [UsersController::class, 'me'])->name('user.show');
                    // 编辑当前用户信息
                    Route::patch('user', [UsersController::class, 'update'])->name('user.update');
                    // 上传图片
                    Route::apiResource('images', ImagesController::class);
                    // 发布、修改、删除话题
                    Route::apiResource('topics', TopicsController::class)->only(['store', 'update', 'destroy']);
                    // 发布、删除回复
                    Route::apiResource('topics.replies', RepliesController::class)->only(['store', 'destroy']);
                    // 通知列表
                    Route::apiResource('notifications', NotificationsController::class)->only(['index']);
                    // 通知统计
                    Route::get('notifications/stats', [NotificationsController::class, 'stats'])->name('notifications.stats');
                    // 标记消息通知为已读
                    Route::patch('user/read/notifications', [NotificationsController::class, 'read'])->name('user.notifications.read');
                    // 当前登录用户权限
                    Route::get('user/permissions', [PermissionsController::class, 'index'])->name('user.permissions.index');
                });
            });
    });
