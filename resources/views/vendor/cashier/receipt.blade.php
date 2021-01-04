<?php
/**
 * @var Invoice $invoice
 * @var InvoiceItem $item
 */

use Laravel\Cashier\Invoice;
use Stripe\InvoiceItem;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechnung</title>
    <style>
        body {
            background: #fff none;
            font-size: 12px;
        }
        .logo {
            display: block;
            width: 100px;
            height: 100px;
            margin: 0 0 10px 15px;
        }
        h2 {
            font-size: 28px;
            color: #ccc;
        }
        .container {
            padding-top: 30px;
        }
        .invoice-head td {
            padding: 0 8px;
        }
        .table th {
            vertical-align: bottom;
            font-weight: bold;
            padding: 8px;
            line-height: 20px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .table tr.row td {
            border-bottom: 1px solid #ddd;
        }
        .table td {
            padding: 8px;
            line-height: 20px;
            text-align: left;
            vertical-align: top;
        }
    </style>
</head>
<body>
<div class="container">
    <table style="margin-left: auto; margin-right: auto;" width="550">
        <tr>
            <td width="160">
                &nbsp;
            </td>

            <!-- Organization Name / Image -->
            <td align="right">
                <strong>{{ $header ?? $vendor->name }}</strong>
            </td>
        </tr>
        <tr valign="top">
            <td style="font-size: 28px; color: #ccc;">
                @lang('Rechnung')
            </td>

            <!-- Organization Name / Date -->
            <td>
                <br><br>
                <strong>An:</strong> {{ $owner->stripeEmail() ?: $owner->name }}
                <br>
                <strong>Datum:</strong> {{ $invoice->date()->formatLocalized('%d.%m.%Y') }}
            </td>
        </tr>
        <tr valign="top">
            <!-- Organization Details -->
            <td style="font-size:11px;">
                <h3>{{ $vendor->name }}</h3>
                <img class="img-rounded logo" width="100" height="100" src="data:image/png;base64,{{ $logo }}"><br>
                {{ $vendor->street }}, {{ $vendor->postcode }} {{ $vendor->city }}<br>
                <strong>Fon</strong> {{ $vendor->phone }}<br>
                <a href="mailto:{{ $vendor->email }}">{{ $vendor->email }}</a><br>
                <a href="{{ $vendor->url }}">{{ $vendor->url }}</a><br>
            </td>
            <td>
                <!-- Invoice Info -->
                <p>
                    <strong>Produkt:</strong> {{ $product }}<br>
                    <strong>Rechnungs Nummer:</strong> {{ $id ?? $invoice->number }}<br>
                </p>

                <!-- Extra / VAT Information -->
                @if (isset($vat))
                    <p>
                        @lang('MWSt'): {{ $vat }}
                    </p>
                @endif

                <br><br>

                <!-- Invoice Table -->
                <table width="100%" class="table" border="0">
                    <tr>
                        <th align="left">@lang('Artikel')</th>
                        <th align="left">@lang('Anzahl')</th>
                        @if ($invoice->hasTax())
                            <th align="right">Tax</th>
                        @endif
                        <th align="right">Total</th>
                    </tr>

                    <!-- Display The Invoice Items -->
                    @foreach ($invoice->invoiceItems() as $item)
                        <tr class="row">
                            <td>{{ $item->description }}
                                @if($item->metadata->size)
                                &nbsp;
                                    (Größe {{ $item->metadata->size }})
                                @endif
                            </td>
                            <td>{{ $item->quantity }} @lang('Stück')
                                a {{ $item->price->unit_amount/100 }} €
                            </td>
                            @if ($invoice->hasTax())
                                <td>
                                    @if ($inclusiveTaxPercentage = $item->inclusiveTaxPercentage())
                                        {{ $inclusiveTaxPercentage }}% incl.
                                    @endif

                                    @if ($item->hasBothInclusiveAndExclusiveTax())
                                        +
                                    @endif

                                    @if ($exclusiveTaxPercentage = $item->exclusiveTaxPercentage())
                                        {{ $exclusiveTaxPercentage }}%
                                    @endif
                                </td>
                            @endif
                            <td>{{ $item->total() }}</td>
                        </tr>
                    @endforeach

                    <!-- Display The Subscriptions -->
                    @foreach ($invoice->subscriptions() as $subscription)
                        <tr class="row">
                            <td>Subscription ({{ $subscription->quantity }})</td>
                            <td colspan="2">
                                {{ $subscription->startDateAsCarbon()->formatLocalized('%B %e, %Y') }} -
                                {{ $subscription->endDateAsCarbon()->formatLocalized('%B %e, %Y') }}
                            </td>

                            @if ($invoice->hasTax())
                                <td>
                                    @if ($inclusiveTaxPercentage = $subscription->inclusiveTaxPercentage())
                                        {{ $inclusiveTaxPercentage }}% incl.
                                    @endif

                                    @if ($subscription->hasBothInclusiveAndExclusiveTax())
                                        +
                                    @endif

                                    @if ($exclusiveTaxPercentage = $subscription->exclusiveTaxPercentage())
                                        {{ $exclusiveTaxPercentage }}%
                                    @endif
                                </td>
                            @endif

                            <td>{{ $subscription->total() }}</td>
                        </tr>
                    @endforeach

                    <!-- Display The Subtotal -->
                    @if ($invoice->hasDiscount() || $invoice->hasTax() || $invoice->hasStartingBalance())
                        <tr>
                            <td colspan="{{ $invoice->hasTax() ? 3 : 2 }}" style="text-align: right;">@lang('Netto')</td>
                            <td>@nettoRounded((int)$invoice->total/100) €</td>
                        </tr>
                    @endif

                    <!-- Display The Discount -->
                    @if ($invoice->hasDiscount())
                        <tr>
                            <td colspan="{{ $invoice->hasTax() ? 3 : 2 }}" style="text-align: right;">
                                @if ($invoice->discountIsPercentage())
                                    {{ $invoice->coupon() }} ({{ $invoice->percentOff() }}% Off)
                                @else
                                    {{ $invoice->coupon() }} ({{ $invoice->amountOff() }} Off)
                                @endif
                            </td>

                            <td>-{{ $invoice->discount() }}</td>
                        </tr>
                    @endif

                    <!-- Display The Taxes -->
                    @unless ($invoice->isNotTaxExempt())
                        <tr>
                            <td colspan="{{ $invoice->hasTax() ? 3 : 2 }}" style="text-align: right;">
                                @if ($invoice->isTaxExempt())
                                    Tax is exempted
                                @else
                                    Tax to be paid on reverse charge basis
                                @endif
                            </td>
                            <td></td>
                        </tr>
                    @else
                        @foreach ($invoice->taxes() as $tax)
                            <tr>
                                <td colspan="3" style="text-align: right;">
                                    {{ $tax->display_name }} {{ $tax->jurisdiction ? ' - '.$tax->jurisdiction : '' }}
                                    ({{ $tax->percentage }}%{{ $tax->isInclusive() ? ' incl.' : '' }})
                                </td>
                                <td>{{ $tax->amount() }}</td>
                            </tr>
                        @endforeach
                    @endunless

                    <!-- Starting Balance -->
                    @if ($invoice->hasStartingBalance())
                        <tr>
                            <td colspan="{{ $invoice->hasTax() ? 3 : 2 }}" style="text-align: right;">
                                Customer Balance
                            </td>
                            <td>{{ $invoice->startingBalance() }}</td>
                        </tr>
                    @endif

                    <!-- Display The Final Total -->
                    <tr>
                        <td colspan="{{ $invoice->hasTax() ? 3 : 2 }}" style="text-align: right;">
                            <strong>@lang('Brutto')</strong>
                        </td>
                        <td>
                            <strong>{{ $invoice->total() }}</strong>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
