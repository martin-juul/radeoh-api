<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NowPlayingController extends Controller
{
    public function get(Request $request)
    {
        $slug = $request->query('slug');
        $station = Station::whereSlug($slug)->firstOrFail();


        $res = Http::get("https://feed.tunein.com/profiles/$station->guide_id/nowPlaying")->json();

        return response()->json([
            'track' => $res['Header']['Subtitle'],
        ]);
    }
}
