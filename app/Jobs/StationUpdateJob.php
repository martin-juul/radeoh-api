<?php

namespace App\Jobs;

use App\Console\Commands\CrawlRadioTime;
use App\Console\Commands\ParseStationStreams;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class StationUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        Redis::funnel(Str::slug(self::class))
            ->block(3)
            ->then(function () {
                $this->callCommand(CrawlRadioTime::SIGNATURE);
                $this->callCommand(ParseStationStreams::SIGNATURE);
            }, function () {
                return $this->release(10);
            });
    }

    private function callCommand(string $signature): void
    {
        $result = Artisan::call($signature);

        if ($result !== 0) {
            throw new \RuntimeException("{$signature} failed. Check logs");
        }
    }
}
