<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
			'id'    => $this->id,
			'size'  => $this->size,
            'url'   => $this->url,
            'file_name' => $this->file_name,
		];
    }
}
