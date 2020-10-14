<?php

namespace App\Models;

use App\Models\AbstractModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

/**
 * App\Models\Station
 *
 * @property string $id
 * @property string $title
 * @property string $country_code
 * @property string $language
 * @property string $slug
 * @property string $guide_id
 * @property string|null $m3u_url
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $subtext
 * @property string|null $bitrate
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stream[] $streams
 * @property-read int|null $streams_count
 * @method static \Illuminate\Database\Eloquent\Builder|AbstractModel disableCache()
 * @method static \Illuminate\Database\Eloquent\Builder|Station findSimilarSlugs($attribute, $config, $slug)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Station newModelQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Station newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Station query()
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereBitrate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereGuideId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereM3uUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereSubtext($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AbstractModel withCacheCooldownSeconds($seconds = null)
 * @mixin \Eloquent
 */
class Station extends AbstractModel
{
    use Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        'title',
        'country_code',
        'language',
        'slug',
        'guide_id',
        'm3u_url',
        'image',
        'subtext',
        'bitrate'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['country_code', 'title'],
            ],
        ];
    }

    public function streams()
    {
        return $this->hasMany(Stream::class);
    }
}
