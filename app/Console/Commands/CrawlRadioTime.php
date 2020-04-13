<?php

namespace App\Console\Commands;

use App\Models\Station;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class CrawlRadioTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:radio-time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl Radio Time (currently only DK->Odense)';

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Throwable
     */
    public function handle()
    {
        $url = 'http://opml.radiotime.com/Browse.ashx?id=r101683&render=json';
        $res = Http::get($url);

        $stations = Arr::get($res->json(), 'body')[0];
        $stations = Arr::get($stations, 'children');

        foreach ($stations as $station) {
            if ($station['item'] !== 'station') {
                continue;
            }

            if (Station::whereGuideId($station['guide_id'])->exists()) {
                continue;
            }

            $model = Station::make([
                'title'        => $station['text'],
                'country_code' => 'DK',
                'language'     => 'Danish',
                'guide_id'     => $station['guide_id'],
                'image'        => $station['image'],
                'm3u_url'      => $station['URL'],
            ]);

            $model->saveOrFail();
        }
    }
}
