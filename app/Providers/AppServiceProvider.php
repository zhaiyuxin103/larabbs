<?php

namespace App\Providers;

use App\Models\User;
use App\View\Composers\CategoryTreeComposer;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Saade\FilamentLaravelLog\Pages\ViewLog;
use Studio\Totem\Totem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        if (app()->isLocal()) {
            $this->app->register('VIACreative\SudoSu\ServiceProvider');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // 当 Laravel 渲染 topics.index 和 topics.show 模版时，就会使用 CategoryComposer 这个来注入类目树变量
        // 同时 Laravel 还支持通配符，例如 topics.* 即代表当渲染 topics 目录下的模版时都会执行这个 Composer
        View::composer(['topics.index', 'topics.show'], CategoryTreeComposer::class);

        ViewLog::can(function (User $user) {
            return in_array($user->email, [
                'zhaiyuxin103@gmail.com',
                'zhaiyuxin103@hotmail.com',
            ]);
        });

        JsonResource::withoutWrapping();

        Totem::auth(function ($request) {
            // return true / false . For e.g.
            return Auth::check();
        });
    }
}
