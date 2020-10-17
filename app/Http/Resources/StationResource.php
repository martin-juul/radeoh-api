<?php

namespace App\Http\Resources;

use App\Http\Resources\Traits\ApplyJsonEncodingOptions;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

/**
 * @mixin \App\Models\Station
 */
class StationResource extends JsonResource
{
    use ApplyJsonEncodingOptions;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title'      => $this->title,
            'slug'       => $this->slug,
            'country'    => $this->country_code,
            'lang'       => $this->language,
            'image'      => $this->image,
            'subtext'    => $this->subtext,
            'bitrate'    => $this->bitrate,
            'stream_url' => $this->whenLoaded('streams', function () {
                if (!$this->streams_count) {
                    return null;
                }

                return $this->streams->first()->stream_url;
            }),
        ];
    }
}
