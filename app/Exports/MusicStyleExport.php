<?php

namespace App\Exports;

use App\Models\MusicStyle;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MusicStyleExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return MusicStyle::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            trans('admin.music-style.columns.id'),
            trans('admin.music-style.columns.name'),
            trans('admin.music-style.columns.slug'),
        ];
    }

    /**
     * @param MusicStyle $musicStyle
     * @return array
     *
     */
    public function map($musicStyle): array
    {
        return [
            $musicStyle->id,
            $musicStyle->name,
            $musicStyle->slug,
        ];
    }
}
