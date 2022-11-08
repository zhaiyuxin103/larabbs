<?php

namespace App\Observers;

use App\Handlers\SlugTranslateHandler;
use App\Models\Topic;

class TopicObserver
{
    /**
     * Handle the Topic "created" event.
     *
     * @param  Topic  $topic
     * @return void
     */
    public function created(Topic $topic): void
    {
        //
    }

    /**
     * Handle the Topic "updated" event.
     *
     * @param  Topic  $topic
     * @return void
     */
    public function updated(Topic $topic): void
    {
        //
    }

    public function saving(Topic $topic): void
    {
        $topic->body = clean($topic->body, 'user_topic_body');

        $topic->excerpt = make_excerpt($topic->body);

        // 如果 slug 字段无内容，即使用翻译器对 title 进行翻译
        if (! $topic->slug || $topic->isDirty('title')) {
            $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
        }
    }

    /**
     * Handle the Topic "deleted" event.
     *
     * @param  Topic  $topic
     * @return void
     */
    public function deleted(Topic $topic): void
    {
        //
    }

    /**
     * Handle the Topic "restored" event.
     *
     * @param  Topic  $topic
     * @return void
     */
    public function restored(Topic $topic): void
    {
        //
    }

    /**
     * Handle the Topic "force deleted" event.
     *
     * @param  Topic  $topic
     * @return void
     */
    public function forceDeleted(Topic $topic): void
    {
        //
    }
}
