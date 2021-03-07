<?php

namespace App\Http\Resources;

use App\Entities\ImageEntity;
use App\Models\Event;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpaEventResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /**
         * @var $this Event
         */
        $category 	= $this->getCategory();
        $theme		= $this->getTheme();
        $links		= $this->getLinks();
        $images		= $this->getImages()->map->getUrl();

        return [
            'id'            => $this->getId(),
            'date'    		=> (string) $this->getEventDate()->format('Y-m-d 00:00:00'),
            'time'    		=> (string) $this->getEventTime(),
            'title'         => $this->getTitle(),
            'subtitle'      => $this->getSubtitle(),
            'description'   => $this->getDescriptionSanitized(),
            'category'      => $category ? $category->name : null,
            'theme'      	=> $theme ? $theme->name : null,
            'links'         => ($links && $links->count()) ? implode("\n", $links->toArray()): null,
            'images'        => $images,
        ];
    }
}
