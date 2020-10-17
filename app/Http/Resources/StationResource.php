<?php

namespace App\Http\Resources;

use App\Http\Resources\Traits\ApplyJsonEncodingOptions;
use App\Models\Stream;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'title'   => $this->title,
            'slug'    => $this->slug,
            'country' => $this->country_code,
            'lang'    => $this->language,
            'image'   => $this->image,
            'subtext' => $this->subtext,
            'bitrate' => $this->bitrate,
            'streams' => $this->whenLoaded('streams', $this->streamsToList($this->streams)),
        ];
    }

    /**
     * @param Stream[] $streams
     * @return array
     */
    protected function streamsToList(array $streams): array
    {
        $list = [];

        foreach ($streams as $stream) {
            $list[] = $stream->stream_url;
        }

        return $list;
    }
}
