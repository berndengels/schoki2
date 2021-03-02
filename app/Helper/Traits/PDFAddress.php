<?php
namespace App\Helper\Traits;

use App\Models\Shipping;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;

trait PDFAddress
{
    public static function download( Shipping $shipping) {
        /**
         * @var $pdf PDF
         */
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('admin.address.pdf', compact('shipping'));
        $fileName = Str::kebab($shipping->customer->name) . '.pdf';
        return $pdf->download($fileName);
    }
}
