<?php

namespace App\Observers;

use App\Jobs\TranslateSlug;
use App\Models\Topic;
use Illuminate\Support\Facades\DB;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

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

    public function saved(Topic $topic): void
    {
        // 如果 slug 字段无内容，即使用翻译器对 title 进行翻译
        if (! $topic->slug || $topic->isDirty('title')) {
            // 推送任务到队列
            TranslateSlug::dispatch($topic)->afterCommit();
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
        DB::table('replies')->where('topic_id', $topic->id)->update(['deleted_at' => date('Y-m-d H:i:s')]);
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
