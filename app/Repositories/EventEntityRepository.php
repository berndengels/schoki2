<?php
/**
 * EventEntityRepository.php
 *
 * @author    Bernd Engels
 * @created   16.04.19 16:13
 * @copyright Bernd Engels
 */

namespace App\Repositories;

use Carbon\Carbon;
use App\Entities\ImageEntity;
use App\Entities\EventEntity;
use App\Models\EventPeriodic;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EventEntityRepository {

	public function mapToEventEntity( $event, $date )
	{
		if(!$event) {
			return null;
		}

		$attributes = $event->getAttributes();
		unset($attributes['event_date']);
		$entity 	= new EventEntity($attributes);
		$dateObj	= Carbon::createFromFormat('Y-m-d', $date, 'Europe/Berlin');
		$entity
			->setEventDate($dateObj)
			->setDomId('e' . $dateObj->format('Ymd'))
			->setDescriptionSanitized($event->descriptionSanitized)
            ->setImages($this->getImageEntities($event->images))
			->setIsPeriodic($event instanceof EventPeriodic ? 1 : 0)
			->setCategory($event->category ? $event->category : null)
			->setTheme($event->theme ? $event->theme : null)
            ->setLinks($event->links)
			->setCreatedBy($event->createdBy)
			->setUpdatedBy($event->updatedBy ? $event->updatedBy : $event->createdBy)
		;

		return $entity;
	}

	public function mapToEventEntityCollection( $data )
	{
		$events = [];
		if( count($data) > 0 ) {
			foreach($data as $date => $item) {
				$attributes = $item->getAttributes();
				unset($attributes['event_date']);
				$event 		= new EventEntity($attributes);
				$dateObj	= Carbon::createFromFormat('Y-m-d', $date, 'Europe/Berlin');
				$event
					->setEventDate($dateObj)
					->setDomId('e' . $dateObj->format('Ymd'))
					->setDescriptionSanitized($item->descriptionSanitized)
                    ->setImages($this->getImageEntities($item->images))
					->setIsPeriodic($item instanceof EventPeriodic ? 1 : 0)
					->setCategory($item->category ? $item->category : null)
					->setTheme($item->theme ? $item->theme : null)
                    ->setLinks($item->links)
					->setCreatedBy($item->createdBy)
					->setUpdatedBy($item->updatedBy ? $item->updatedBy : $item->createdBy)
				;

				$events[$date] = $event;
			}
			return collect($events);
		}

		return collect([]);
	}

	protected function getImageEntities(Collection $images): Collection
    {
        if($images && $images->count()) {
            /**
             * @var $image Media
             */
            return $images->map(function (Media $image){
                $img = new ImageEntity();
                $img
                    ->setId($image->id)
                    ->setFileName($image->file_name)
                    ->setSize($image->size)
                    ->setUrl($image->getUrl())
                    ->toObject()
                ;
                return $img;
            });
        }

        return collect([]);
    }
}
