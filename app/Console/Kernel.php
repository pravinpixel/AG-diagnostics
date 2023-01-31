<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected $commands = [
        Commands\BranchCron::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('branch:cron')->daily();
        $schedule->call(function (){
            insertApiStateData();
            insertApiCityData();
            insertApiTestData();
            insertApiPackagesData();
            insertApiHomeVisitAreaData();
            insertApiSampleCollectionCentersData();
            info("Test call");
            Log::info("Test Run");
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
