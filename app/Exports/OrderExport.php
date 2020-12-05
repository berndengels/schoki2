<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrderExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return Order::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            trans('admin.order.columns.id'),
            trans('admin.order.columns.shoppingcart_id'),
            trans('admin.order.columns.instance'),
            trans('admin.order.columns.content'),
            trans('admin.order.columns.price_total'),
            trans('admin.order.columns.created_by'),
            trans('admin.order.columns.updated_by'),
            trans('admin.order.columns.delivered'),
        ];
    }

    /**
     * @param Order $order
     * @return array
     *
     */
    public function map($order): array
    {
        return [
            $order->id,
            $order->shoppingcart_id,
            $order->instance,
            $order->content,
            $order->price_total,
            $order->created_by,
            $order->updated_by,
            $order->delivered,
        ];
    }
}
