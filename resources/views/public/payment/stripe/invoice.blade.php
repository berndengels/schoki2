<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $invoice->name }}</title>
    <style>
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        h1,h2,h3,h4,h5,h6,p,span,div {
            font-family: DejaVu Sans;
            font-size:10px;
            font-weight: normal;
        }

        th,td {
            font-family: DejaVu Sans;
            font-size:10px;
        }

        .panel {
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid transparent;
            border-radius: 4px;
            -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
            box-shadow: 0 1px 1px rgba(0,0,0,.05);
        }

        .panel-default {
            border-color: #ddd;
        }

        .panel-body {
            padding: 15px;
        }

        table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 0px;
            border-spacing: 0;
            border-collapse: collapse;
            background-color: transparent;

        }

        thead  {
            text-align: left;
            display: table-header-group;
            vertical-align: middle;
        }

        th, td  {
            border: 1px solid #ddd;
            padding: 6px;
        }

        .well {
            min-height: 20px;
            padding: 19px;
            margin-bottom: 20px;
            background-color: #f5f5f5;
            border: 1px solid #e3e3e3;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
        }
    </style>
    @if($invoice->duplicate_header)
        <style>
            @page { margin-top: 140px;}
            header {
                top: -100px;
                position: fixed;
            }
        </style>
    @endif
</head>
<body>
<header>
    <div style="position:absolute; left:0pt; width:250pt;">
        <img class="img-rounded" height="{{ $invoice->logo_height }}" src="{{ $invoice->logo }}">
    </div>
    <div style="margin-left:300pt;">
        <b>Date: </b> {{ $invoice->date->formatLocalized('%A %d %B %Y') }}<br />
        @if ($invoice->due_date)
            <b>Due date: </b>{{ $invoice->due_date->formatLocalized('%A %d %B %Y') }}<br />
        @endif
        @if ($invoice->number)
            <b>Invoice #: </b> {{ $invoice->number }}
        @endif
        <br />
    </div>
    <br />
    <h2>{{ $invoice->name }} {{ $invoice->number ? '#' . $invoice->number : '' }}</h2>
</header>
<main>
    <div style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt; width:250pt;">
            <h4>Business Details:</h4>
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! $invoice->business->count() == 0 ? '<i>No business details</i><br />' : '' !!}
                    {{ $invoice->business->get('name') }}<br />
                    ID: {{ $invoice->business->get('id') }}<br />
                    {{ $invoice->business->get('phone') }}<br />
                    {{ $invoice->business->get('location') }}<br />
                    {{ $invoice->business->get('zip') }} {{ $invoice->business->get('city') }}
                    {{ $invoice->business->get('country') }}<br />
                </div>
            </div>
        </div>
        <div style="margin-left: 300pt;">
            <h4>Customer Details:</h4>
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! $invoice->customer->count() == 0 ? '<i>No customer details</i><br />' : '' !!}
                    {{ $invoice->customer->get('name') }}<br />
                    ID: {{ $invoice->customer->get('id') }}<br />
                    {{ $invoice->customer->get('phone') }}<br />
                    {{ $invoice->customer->get('location') }}<br />
                    {{ $invoice->customer->get('zip') }} {{ $invoice->customer->get('city') }}
                    {{ $invoice->customer->get('country') }}<br />
                </div>
            </div>
        </div>
    </div>
    <h4>Artikel:</h4>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Bild</th>
            <th>ID</th>
            <th>Artikel</th>
            <th>Preis</th>
            <th>Anzahl</th>
            <th>Preis total</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($invoice->items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if(isset($item->imageUrl))
                        <img src="{{ url($item->get('imageUrl')) }}" />
                    @endif
                </td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->price }} {{ $invoice->currency }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price_total }} {{ $invoice->currency }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div style="clear:both; position:relative;">
        @if(isset($invoice->notes))
            <div style="position:absolute; left:0pt; width:250pt;">
                <h4>Notes:</h4>
                <div class="panel panel-default">
                    <div class="panel-body">
                        {{ $invoice->notes }}
                    </div>
                </div>
            </div>
        @endif
        <div style="margin-left: 300pt;">
            <h4>Total:</h4>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td><b>Subtotal</b></td>
                    <td>{{ $invoice->price_total_netto }} {{ $invoice->currency }}</td>
                </tr>
                <tr>
                    <td><b>Mehrwertsteuer</b></td>
                    <td>{{ $invoice->tax_total }} {{ $invoice->currency }}</td>
                </tr>
                <tr>
                    <td><b>TOTAL</b></td>
                    <td><b>{{ $invoice->price_total_brutto }} {{ $invoice->currency }}</b></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    @if (isset($invoice->footnote))
        <br /><br />
        <div class="well">
            {{ $invoice->footnote }}
        </div>
    @endif
</main>

<!-- Page count -->
<script type="text/php">
    if (isset($pdf) && $GLOBALS['with_pagination'] && $PAGE_COUNT > 1) {
        $pageText = "{PAGE_NUM} of {PAGE_COUNT}";
        $pdf->page_text(($pdf->get_width()/2) - (strlen($pageText) / 2), $pdf->get_height()-20, $pageText, $fontMetrics->get_font("DejaVu Sans, Arial, Helvetica, sans-serif", "normal"), 7, array(0,0,0));
    }
</script>
</body>
</html>
