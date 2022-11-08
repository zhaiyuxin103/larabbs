<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Reply;
use App\Models\Topic;
use App\Observers\CategoryObserver;
use App\Observers\ReplyObserver;
use App\Observers\TopicObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * 应用程序的模型观察者。
     *
     * @var array
     */
    protected $observers = [
        Category::class => [CategoryObserver::class],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        Reply::observe(ReplyObserver::class);
        Topic::observe(TopicObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
