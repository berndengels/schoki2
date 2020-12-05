<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return Product::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            trans('admin.product.columns.id'),
            trans('admin.product.columns.name'),
            trans('admin.product.columns.description'),
            trans('admin.product.columns.price'),
            trans('admin.product.columns.is_published'),
            trans('admin.product.columns.is_available'),
            trans('admin.product.columns.created_by'),
            trans('admin.product.columns.updated_by'),
        ];
    }

    /**
     * @param Product $product
     * @return array
     *
     */
    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->description,
            $product->price,
            $product->is_published,
            $product->is_available,
            $product->created_by,
            $product->updated_by,
        ];
    }
}
