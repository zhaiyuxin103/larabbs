<?php

namespace App\Console\Commands;

use App\Models\Topic;
use Illuminate\Console\Command;

class SyncTopicPV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larabbs:sync-topic-pv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '将 Redis 中话题的 PV 同步到 MySQL 数据表中的 view_count 字段';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        Topic::all()->each(function ($topic) {
            if ($topic->view_count < $topic->visits()->count()) {
                $topic->view_count = $topic->visits()->count();
                $topic->save();
            } else {
                visits($topic)->forceDecrement($topic->visits()->count());
                visits($topic)->forceIncrement($topic->view_count);
            }
        });
        $this->info('同步成功！');
    }
}
