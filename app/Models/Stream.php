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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbstractModel disableCache()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream whereStationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream whereStreamUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbstractModel withCacheCooldownSeconds($seconds = null)
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
