<?php

namespace App\Http\Controllers;

use App\Http\Resources\StationResource;
use App\Models\Station;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stations = Station::whereHas('streams')->get();

        return view('spa', [
            'title'    => 'Radeoh',
            'stations' => StationResource::collection($stations),
        ]);
    }

    public function docs() {
        return response(\File::get(public_path('docs/index.html')));
    }
}
