<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        Commands\ReserveReminder::Class,
        Commands\S3Upload::Class,
    ];

    protected function schedule(Schedule $schedule)
    {
        //毎朝八時に該当者に予約通知メールを送信する
//        $schedule->command('reserve')->dailyAt('8:00')->timezone('Asia/Tokyo');
        $schedule->command('reserve')->everyMinute()->timezone('Asia/Tokyo');

    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
