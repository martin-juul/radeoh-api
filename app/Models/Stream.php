<?php

namespace App\Models;

use App\Models\AbstractModel;

/**
 * App\Models\Stream
 *
 * @property string $id
 * @property string $station_id
 * @property string $stream_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Station $station
 * @method static \Illuminate\Database\Eloquent\Builder|AbstractModel disableCache()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Stream newModelQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Stream newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Stream query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stream whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stream whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stream whereStationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stream whereStreamUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stream whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AbstractModel withCacheCooldownSeconds($seconds = null)
 * @mixin \Eloquent
 */
class Stream extends AbstractModel
{
    protected $fillable = [
        'stream_url',
    ];

    public function station()
    {
        return $this->belongsTo(Station::class);
    }
}
