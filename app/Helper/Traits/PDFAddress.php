<?php
namespace App\Helper\Traits;

use App\Models\Shipping;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade as PDF;

trait PDFAddress
{
    public static function download( Shipping $shipping) {
        /**
         * @var $pdf PDF
         */
        $pdf = PDF::loadView('admin.address.pdf', compact('shipping'));
        $fileName = Str::kebab($shipping->customer->name) . '.pdf';
        return $pdf->download($fileName);
    }
}
