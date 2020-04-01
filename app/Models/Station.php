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
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbstractModel disableCache()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Station findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Station newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Station newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Station query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Station whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Station whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Station whereGuideId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Station whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Station whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Station whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Station whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Station whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Station whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbstractModel withCacheCooldownSeconds($seconds = null)
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
        'image',
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
}
