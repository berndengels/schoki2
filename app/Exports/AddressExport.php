<?php

namespace App\Exports;

use App\Models\Address;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AddressExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return Address::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            trans('admin.address.columns.id'),
            trans('admin.address.columns.address_category_id'),
            trans('admin.address.columns.email'),
            trans('admin.address.columns.token'),
            trans('admin.address.columns.info_on_changes'),
        ];
    }

    /**
     * @param Address $address
     * @return array
     *
     */
    public function map($address): array
    {
        return [
            $address->id,
            $address->address_category_id,
            $address->email,
            $address->token,
            $address->info_on_changes,
        ];
    }
}
