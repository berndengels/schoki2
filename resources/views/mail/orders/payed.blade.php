<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body style="font-size: 11px ;color: #666; font-family:arial;">
<div>
    <h3>Eine Bestellung wurde erfolgreich bezahlt</h3>
    <table class="table">
        <tr>
            <td>Kunde: </td>
            <td>
                {{ $customer->name }} <a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a><br>
                {{ $customer->shipping->street }}, {{ $customer->shipping->postcode }} {{ $customer->shipping->city }}
            </td>
        </tr>
        <tr>
            <td>Summe Total: </td>
            <td>{{ $params['amount_received'] }} €</td>
        </tr>
        <tr>
            <td>bezahlt am: </td>
            <td>{{ $params['paid_on'] ?? null }}</td>
        </tr>
        <tr>
            <td>bezaht bei: </td>
            <td>{{ $params['payment_provider'] }}</td>
        </tr>
        <tr>
            <td>Payment ID: </td>
            <td>{{ $params['payment_id'] }}</td>
        </tr>
    </table>
    <h3>folgende Artikel wurden bestellt</h3>
    <table>
        @foreach($order->orderItems as $item)
            <tr>
                <td>Artikel</td>
                <td>{{ $item->product->name }}</td>
            </tr>
            <tr>
                <td>Anzahl</td>
                <td>{{ $item->qty }}</td>
            </tr>
            <tr>
                <td>Preis</td>
                <td>{{ $item->product->price }}</td>
            </tr>
            <tr>
                <td>Summe Preis</td>
                <td>{{ $item->price_total }}</td>
            </tr>
        @endforeach
    </table>
</div>
</body>
</html>
