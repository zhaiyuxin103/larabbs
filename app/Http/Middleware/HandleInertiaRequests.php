<?php

namespace App\Http\Middleware;

use App\Models\Link;
use App\Models\User;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'categoryTree' => (new CategoryService())->getCategoryTree(),
            'can' => [
                'dashboard' => optional($request->user())->hasPermissionTo('dashboard'),
            ],
            'active_users' => app(User::class)->getActiveUsers(),
            'locales' => [
                ['key' => 'en', 'label' => 'en', 'matice' => 'en', 'name' => 'English'],
                ['key' => 'ja', 'label' => 'ja', 'matice' => 'ja', 'name' => '日本語'],
                ['key' => 'cs', 'label' => 'zh', 'matice' => 'zh_CN', 'name' => '简体中文'],
                ['key' => 'ct', 'label' => 'zh', 'matice' => 'zh_TW', 'name' => '繁體中文'],
                ['key' => 'ko', 'label' => 'ko', 'matice' => 'ko', 'name' => '한국어'],
            ],
            'links' => app(Link::class)->getAllCached(),
            'route_class' => route_class(),
        ]);
    }
}
