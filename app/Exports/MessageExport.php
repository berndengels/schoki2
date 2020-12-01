<?php

namespace App\Exports;

use App\Models\Message;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MessageExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return Message::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            trans('admin.message.columns.id'),
            trans('admin.message.columns.music_style_id'),
            trans('admin.message.columns.email'),
            trans('admin.message.columns.name'),
            trans('admin.message.columns.message'),
        ];
    }

    /**
     * @param Message $message
     * @return array
     *
     */
    public function map($message): array
    {
        return [
            $message->id,
            $message->music_style_id,
            $message->email,
            $message->name,
            $message->message,
        ];
    }
}
