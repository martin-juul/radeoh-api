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
    protected $signature = 'radiotime:parse-m3u';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $stations = Station::all();

        foreach ($stations as $station) {
            $stream = Http::get($station->m3u_url)->body();

            if (is_array($stream)) {
                $stream = Arr::first($stream);
            }

            if (Str::endsWith($stream, '.m3u')) {
                $stream = Str::beforeLast($stream, '.m3u');
            }

            $station->streams()->firstOrCreate([
                'stream_url' => $stream,
            ]);
        }
    }
}
