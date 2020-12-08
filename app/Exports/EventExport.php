<?php

namespace App\Exports;

use App\Models\Event;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EventExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return Event::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            trans('admin.event.columns.id'),
//            trans('admin.event.columns.theme_id'),
//            trans('admin.event.columns.category_id'),
//            trans('admin.event.columns.created_by'),
//            trans('admin.event.columns.updated_by'),
            trans('admin.event.columns.title'),
            trans('admin.event.columns.subtitle'),
            trans('admin.event.columns.description'),
//            trans('admin.event.columns.links'),
//            trans('admin.event.columns.event_date'),
//            trans('admin.event.columns.event_time'),
//            trans('admin.event.columns.price'),
//            trans('admin.event.columns.is_published'),
        ];
    }

    /**
     * @param Event $event
     * @return array
     *
     */
    public function map($event): array
    {
        return [
            $event->id,
//            $event->theme_id,
//            $event->category_id,
//            $event->created_by,
//            $event->updated_by,
            $event->title,
            $event->subtitle,
            $event->description,
//            $event->links,
//            $event->event_date,
//            $event->event_time,
//            $event->price,
//            $event->is_published,
        ];
    }
}
