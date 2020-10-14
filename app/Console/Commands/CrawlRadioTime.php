<?php

namespace App\Console\Commands;

use App\Models\Station;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class CrawlRadioTime extends Command
{
    public const SIGNATURE = 'crawl:radio-time';

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
            if (Arr::get($station, 'item') !== 'station') {
                continue;
            }

            $guideId = Arr::get($station, 'guide_id');
            if (!$guideId) {
                continue;
            }

            if (Station::whereGuideId($guideId)->exists()) {
                $bitrate = Arr::get($station, 'bitrate');
                $subtext = Arr::get($station, 'subtext');

                if ($subtext) {
                    Station::whereGuideId($guideId)
                        ->update([
                            'bitrate' => $bitrate,
                            'subtext' => $subtext,
                        ]);
                }

                continue;
            }

            $model = Station::make([
                'title'        => Arr::get($station, 'text'),
                'country_code' => 'DK',
                'language'     => 'Danish',
                'guide_id'     => $station['guide_id'],
                'image'        => $station['image'],
                'm3u_url'      => trim(strip_tags($station['URL'])),
            ]);

            $model->saveOrFail();
        }
    }
}
