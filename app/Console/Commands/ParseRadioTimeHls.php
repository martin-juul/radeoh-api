<?php

namespace App\Console\Commands;

use App\Models\Station;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ParseRadioTimeHls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stations:parse-streams';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parses streams belonging to known stations.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Parsing urls. Please wait..');

        Station::query()->chunk(50, static function ($stations) {
            foreach ($stations as $station) {
                $stream = Http::get($station->m3u_url)->body();

                if (is_array($stream)) {
                    $stream = Arr::first($stream);
                }

                if (Str::endsWith($stream, '.m3u')) {
                    $stream = Str::before($stream, '.m3u');
                }

                $station->streams()->firstOrCreate([
                    'stream_url' => $stream,
                ]);
            }
        });

        $this->info('Done..');
    }
}
