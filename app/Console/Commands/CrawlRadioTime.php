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
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = "http://opml.radiotime.com/Browse.ashx?c=local&render=json";
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
            ]);

            dump($model);

            $model->saveOrFail();
        }
    }
}
