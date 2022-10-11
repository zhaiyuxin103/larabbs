<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     * 全局中间件
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        // 修正代理服务器后的服务器参数
        \App\Http\Middleware\TrustProxies::class,
        // 解决 cors 跨域问题
        \Illuminate\Http\Middleware\HandleCors::class,
        // 检测应用是否进入「维护模式」
        // 见：https://learnku.com/docs/laravel/9.x/configuration/12201#maintenance-mode
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        // 检测表单请求的数据是否过大
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        // 对所有提交的请求数据进行 PHP 函数 `trim()` 处理
        \App\Http\Middleware\TrimStrings::class,
        // 将提交请求参数中空字符串转化为 null
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     * 设定中间件组
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [

        // Web 中间件组，应用于 routes/web.php 路由文件
        // 在 RouteServiceProvider 中设定
        'web' => [
            // Cookie 加密解密
            \App\Http\Middleware\EncryptCookies::class,
            // 将 Cookie 添加到响应中
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            // 开启会话
            \Illuminate\Session\Middleware\StartSession::class,
            // 将系统的错误数据注入到视图变量 $errors 中
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            // 检验 CSRF，防止跨站请求伪造的安全威胁
            // 见：https://learnku.com/docs/laravel/9.x/csrf
            \App\Http\Middleware\VerifyCsrfToken::class,
            // 处理路由绑定
            // 见：https://learnku.com/docs/laravel/9.x/routing#route-model-binding
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\HandleInertiaRequests::class,

            // 记录用户最后活跃时间
            \App\Http\Middleware\RecordLastActivedTime::class,
        ],

        // API 中间件组，应用于 routes/api.php 路由文件
        // 在 RouteServiceProvider 中设定
        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            // 使用别名来调用中间件
            // 见：https://learnku.com/docs/laravel/9.x/middleware#为路由分配中间件
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     * 中间件别名设置，允许使用别名调用中间件，例如上面的 api 中间件组调用
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        // 只有登录用户才能访问，在控制器的构造方法中大量使用
        'auth' => \App\Http\Middleware\Authenticate::class,
        // HTTP Basic Auth 认证
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        // 缓存标头
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        // 用户授权功能
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        // 只有游客才能访问，在 register 和 login 请求中使用，只有未登录用户才能访问这些页面
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        // 密码确认，可以在做一些安全级别较高的修改时使用，例如支付前进行密码确认
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        // 签名认证，在找回密码章节里使用过
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        // 访问节流，类似于「1 分钟只能请求 10 次」的需求，一般在 API 中使用
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        // 强制用户邮箱认证
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
