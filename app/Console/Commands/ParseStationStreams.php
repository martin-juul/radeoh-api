<?php

namespace App\Console\Commands;

use App\Models\Station;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ParseStationStreams extends Command
{
    public const SIGNATURE = 'stations:parse-streams';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = self::SIGNATURE;

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

        Station::query()->chunk(5, function ($stations) {
            /** @var Station $station */
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

                // HACK: Remove planetradio redirect
                if (Str::contains($stream, 'https://tx.planetradio.co.uk')) {
                    if (!Str::contains('bauerdk', $stream)) {
                        return;
                    }
                    $raw = Str::after($stream, 'https://tx.planetradio.co.uk/');
                    $host = Str::after($raw, 'http_');
                    $stream = Str::replaceFirst('_', '-', $host);
                    $stream = Str::replaceFirst('bauerdk', 'bauer.dk', $stream);
                    $stream = "https://{$stream}";
                }

                $dupes = explode("\n", $stream);
                if (is_array($dupes)) {
                    $dupesAsJson = json_encode($dupes, JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
                    $stream = $dupes[0];

                    $this->info("Found dupe or unexpected line terminator. Normalizing: $dupesAsJson => $stream");
                }

                if (!filter_var($stream, FILTER_VALIDATE_URL)) {
                    $this->warn("Invalid stream {$stream}");
                    return;
                }

                $station->streams()->delete();


                $station->streams()->create([
                    'stream_url' => $stream,
                ]);
            }
        });

        return self::SUCCESS;
    }
}
