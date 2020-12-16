<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body style="color: #666; font-family:'Open Sans',sans-serif;">
<div>
    <h5>Eine Bestellung wurde erfolgreich bezahlt</h5>
    <table class="table">
        <tr>
            <td>Kunde: </td>
            <td>{{ $customer->name }} {{ $customer->email }}</td>
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
            <td>Order ID: </td>
            <td>{{ $orderId }}</td>
        </tr>
        <tr>
            <td>bezaht bei: </td>
            <td>{{ $params['payment_provider'] }}</td>
        </tr>
        <tr>
            <td>Payment ID: </td>
            <td>{{ $params['payment_id'] }}}}</td>
        </tr>
    </table>
</div>
</body>
</html>
