<?php

namespace App\Console\Commands;

use App\Models\Station;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ParseStationStreams extends Command
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

        Station::query()->chunk(50, function ($stations) {
            foreach ($stations as $station) {
                $stream = Http::get($station->m3u_url)->body();
                $stream = trim(strip_tags($stream));

                if (is_array($stream)) {
                    $stream = Arr::first($stream);
                }

                if (Str::endsWith($stream, '.m3u')) {
                    $stream = Str::before($stream, '.m3u');
                }

                // HACK: Fix Danish DR channels
                if (Str::contains($stream, 'http://live-icy.gss.dr.dk')) {
                    $path = Str::after($stream, 'http://live-icy.gss.dr.dk');
                    $stream = 'https://live-icy.dr.dk' . $path;
                }

                $dupes = explode("\n", $stream);
                if (is_array($dupes)) {
                    $dupesAsJson = json_encode($dupes, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
                    $stream = $dupes[0];

                    $this->info("Found dupe or unexpected line terminator. Normalizing: $dupesAsJson => $stream");
                }

                $station->streams()->firstOrCreate([
                    'stream_url' => $stream,
                ]);
            }
        });

        $this->info('Done..');
    }
}
