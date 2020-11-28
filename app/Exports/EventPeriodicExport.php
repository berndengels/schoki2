<?php

namespace App\Exports;

use App\Models\EventPeriodic;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EventPeriodicExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return EventPeriodic::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            trans('admin.event-periodic.columns.id'),
            trans('admin.event-periodic.columns.theme_id'),
            trans('admin.event-periodic.columns.category_id'),
            trans('admin.event-periodic.columns.periodic_position'),
            trans('admin.event-periodic.columns.periodic_weekday'),
            trans('admin.event-periodic.columns.created_by'),
            trans('admin.event-periodic.columns.updated_by'),
            trans('admin.event-periodic.columns.title'),
            trans('admin.event-periodic.columns.subtitle'),
            trans('admin.event-periodic.columns.description'),
            trans('admin.event-periodic.columns.links'),
            trans('admin.event-periodic.columns.event_date'),
            trans('admin.event-periodic.columns.event_time'),
            trans('admin.event-periodic.columns.price'),
            trans('admin.event-periodic.columns.is_published'),
        ];
    }

    /**
     * @param EventPeriodic $eventPeriodic
     * @return array
     *
     */
    public function map($eventPeriodic): array
    {
        return [
            $eventPeriodic->id,
            $eventPeriodic->theme_id,
            $eventPeriodic->category_id,
            $eventPeriodic->periodic_position,
            $eventPeriodic->periodic_weekday,
            $eventPeriodic->created_by,
            $eventPeriodic->updated_by,
            $eventPeriodic->title,
            $eventPeriodic->subtitle,
            $eventPeriodic->description,
            $eventPeriodic->links,
            $eventPeriodic->event_date,
            $eventPeriodic->event_time,
            $eventPeriodic->price,
            $eventPeriodic->is_published,
        ];
    }
}
