<?php

namespace App\Exports;

use App\Models\EventTemplate;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EventTemplateExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return EventTemplate::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            trans('admin.event-template.columns.id'),
            trans('admin.event-template.columns.theme_id'),
            trans('admin.event-template.columns.category_id'),
            trans('admin.event-template.columns.created_by'),
            trans('admin.event-template.columns.updated_by'),
            trans('admin.event-template.columns.title'),
            trans('admin.event-template.columns.subtitle'),
            trans('admin.event-template.columns.description'),
            trans('admin.event-template.columns.links'),
        ];
    }

    /**
     * @param EventTemplate $eventTemplate
     * @return array
     *
     */
    public function map($eventTemplate): array
    {
        return [
            $eventTemplate->id,
            $eventTemplate->theme_id,
            $eventTemplate->category_id,
            $eventTemplate->created_by,
            $eventTemplate->updated_by,
            $eventTemplate->title,
            $eventTemplate->subtitle,
            $eventTemplate->description,
            $eventTemplate->links,
        ];
    }
}
