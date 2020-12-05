<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;

class ImageResource extends MediaResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'thumb_url' => $this->thumb_url,
		]);
    }
}
