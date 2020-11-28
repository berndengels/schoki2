<?php

namespace App\Exports;

use App\Models\Page;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PageExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return Page::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            trans('admin.page.columns.id'),
            trans('admin.page.columns.created_by'),
            trans('admin.page.columns.updated_by'),
            trans('admin.page.columns.title'),
            trans('admin.page.columns.slug'),
            trans('admin.page.columns.body'),
            trans('admin.page.columns.is_published'),
        ];
    }

    /**
     * @param Page $page
     * @return array
     *
     */
    public function map($page): array
    {
        return [
            $page->id,
            $page->created_by,
            $page->updated_by,
            $page->title,
            $page->slug,
            $page->body,
            $page->is_published,
        ];
    }
}
