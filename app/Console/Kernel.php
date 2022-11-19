<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        // 每日零时执行一次
        $schedule->command('larabbs:sync-user-actived-at')->dailyAt('00:00');
        $schedule->command('telescope:prune')->daily();
        // 一个小时执行一次「活跃用户」数据生成的命令
        $schedule->command('larabbs:calculate-active-user')->hourly();
        $schedule->command('passport:purge')->hourly();
        $schedule->command('backup:clean')->daily()->at('01:00');
        $schedule->command('backup:run')
            ->daily()
            ->at('01:30')
            ->onFailure(function () {
            })
            ->onSuccess(function () {
            });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
