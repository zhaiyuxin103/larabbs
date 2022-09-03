<?php

namespace App\Providers;

use App\View\Composers\CategoryTreeComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 当 Laravel 渲染 topics.index 和 topics.show 模版时，就会使用 CategoryComposer 这个来注入类目树变量
        // 同时 Laravel 还支持通配符，例如 topics.* 即代表当渲染 topics 目录下的模版时都会执行这个 Composer
        View::composer(['topics.index', 'topics.show'], CategoryTreeComposer::class);
    }
}
