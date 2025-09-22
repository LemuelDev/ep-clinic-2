<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        //  --- FOR LOCAL TESTING ONLY ---
        // This will make your reminder command eligible to run every minute
        // $schedule->command('appointments:send-reminders')
        //          ->everyMinute() // <--- CHANGE THIS LINE FOR TESTING
        //          ->timezone('Asia/Manila');

        // // --- FOR PRODUCTION, IT SHOULD BE LIKE THIS: ---
        $schedule->command('appointments:send-reminders')
                 ->dailyAt('08:00')
                 ->timezone('Asia/Manila');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
