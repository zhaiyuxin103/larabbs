<?php

namespace App\Observers;

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
