<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class DispatchJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dispatch:job {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch a job by class name';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $job = $this->argument('name');

        if (Str::length($job) < 1) {
            $this->error("Invalid job ({$job})");
            return 1;
        }

        $job = '\\App\Jobs\\' . $job;

        dispatch_now(new $job());

        $this->info("Pushed {$job} on queue");

        return 0;
    }
}
