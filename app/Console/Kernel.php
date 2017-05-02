<?php

namespace App\Console;

use App\Services\EarningService;
use App\Services\Matcher;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\RefreshDatabase::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        // $schedule->command('queue:work --daemon')->everyMinute()->withoutOverlapping();
        $schedule->call(function ()
        {
           $m = new Matcher;
           $m->createPairings();
        })->everyTenMinutes();

        $schedule->call(function(){
            $e = new EarningService;
            $e->growGrowableFunds();
        })->daily();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
