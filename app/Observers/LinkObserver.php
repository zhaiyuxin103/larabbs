<?php

namespace App\Observers;

use App\Models\Link;
use Illuminate\Support\Facades\Cache;

class LinkObserver
{
    /**
     * Handle the Link "created" event.
     *
     * @param  Link  $link
     * @return void
     */
    public function created(Link $link): void
    {
        //
    }

    /**
     * Handle the Link "updated" event.
     *
     * @param  Link  $link
     * @return void
     */
    public function updated(Link $link): void
    {
        //
    }

    /**
     * Handle the Link "updated" event.
     *
     * @param  Link  $link
     * @return void
     */
    public function saved(Link $link): void
    {
        // 在保存时清空 cache_key 对应的缓存
        Cache::forget($link->cache_key);
    }

    /**
     * Handle the Link "deleted" event.
     *
     * @param  Link  $link
     * @return void
     */
    public function deleted(Link $link): void
    {
        //
    }

    /**
     * Handle the Link "restored" event.
     *
     * @param  Link  $link
     * @return void
     */
    public function restored(Link $link): void
    {
        //
    }

    /**
     * Handle the Link "force deleted" event.
     *
     * @param  Link  $link
     * @return void
     */
    public function forceDeleted(Link $link): void
    {
        //
    }
}
