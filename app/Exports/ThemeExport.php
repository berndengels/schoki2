<?php

namespace App\Exports;

use App\Models\Theme;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ThemeExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return Theme::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            trans('admin.theme.columns.id'),
            trans('admin.theme.columns.name'),
            trans('admin.theme.columns.slug'),
            trans('admin.theme.columns.icon'),
        ];
    }

    /**
     * @param Theme $theme
     * @return array
     *
     */
    public function map($theme): array
    {
        return [
            $theme->id,
            $theme->name,
            $theme->slug,
            $theme->icon,
        ];
    }
}
