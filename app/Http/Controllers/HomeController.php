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
        return view('spa', [
            'title'    => 'Radeoh',
            'stations' => StationResource::collection(Station::get()),
        ]);
    }

    public function showRoutes()
    {
        $middlewareClosure = function ($middleware) {
            return $middleware instanceof \Closure ? 'Closure' : $middleware;
        };

        $routes = collect(\Route::getRoutes());

        foreach (config('dev-route-explorer.hide_matching') as $regex) {
            $routes = $routes->filter(function ($value, $key) use ($regex) {
                return !preg_match($regex, $value->uri());
            });
        }

        return view('dev.route-explorer', [
            'routes'            => $routes,
            'middlewareClosure' => $middlewareClosure,
        ]);
    }
}
