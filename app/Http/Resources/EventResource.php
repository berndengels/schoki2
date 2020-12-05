<?php

namespace App\Http\Resources;

use App\Entities\ImageEntity;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\Conversions\ImageGenerators\Image;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EventResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
		$category 	= $this->getCategory();
		$theme		= $this->getTheme();
		$links		= $this->getLinks();
		$images		= $this->getImages();
		$imageEntities	= [];

		if($images && $images->count()) {
			/**
			 * @var $image Media
			 */
			foreach($images as $image) {
				$img = new ImageEntity();
				$img
                    ->setId($image->getId())
                    ->setFileName($image->getFileName())
                    ->setSize($image->getSize())
                    ->setUrl($image->getUrl())
                    ->setThumbUrl($image->getThumbUrl())
				;
				$imageEntities[] = $img->toObject();
			}
		}
        return [
			'id'            => $this->getId(),
			'date'    		=> (string) $this->getEventDate()->format('Y-m-d 00:00:00'),
			'time'    		=> (string) $this->getEventTime(),
			'title'         => $this->getTitle(),
			'subtitle'      => $this->getSubtitle(),
			'description'   => $this->getDescriptionText(),
            'category'      => $category ? $category->name : null,
            'theme'      	=> $theme ? $theme->name : null,
			'links'         => ($links && $links->count()) ? implode("\n", $links->toArray()): null,
			'images'        => $imageEntities,
		];
    }
}
