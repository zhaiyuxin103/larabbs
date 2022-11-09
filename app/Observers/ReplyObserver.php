<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_topic_body');

        // 判断内容为空的处理方式，拒绝保存入库
        if ($reply->content === '') {
            return false;
        }
    }

    /**
     * Handle the Reply "created" event.
     *
     * @param  Reply  $reply
     * @return void
     */
    public function created(Reply $reply): void
    {
        $reply->topic->updateReplyCount();

        // 通知话题作者有新的评论
        $reply->topic->user->notify(new TopicReplied($reply));
    }

    /**
     * Handle the Reply "updated" event.
     *
     * @param  Reply  $reply
     * @return void
     */
    public function updated(Reply $reply): void
    {
        if ($reply->isDirty('show')) {
            $reply->topic->updateReplyCount();
        }
    }

    /**
     * Handle the Reply "deleted" event.
     *
     * @param  Reply  $reply
     * @return void
     */
    public function deleted(Reply $reply): void
    {
        $reply->topic->updateReplyCount();
    }

    /**
     * Handle the Reply "restored" event.
     *
     * @param  Reply  $reply
     * @return void
     */
    public function restored(Reply $reply): void
    {
        //
    }

    /**
     * Handle the Reply "force deleted" event.
     *
     * @param  Reply  $reply
     * @return void
     */
    public function forceDeleted(Reply $reply): void
    {
        //
    }
}
