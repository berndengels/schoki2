<div>
    <h1>Eine Order wurde erfolgreich bezahl</h1>
    <!--div>Es wurden folgende Artikel bestellt: </div-->
    <table>
        <tr>
            <td>Kunde: </td>
            <td>{{ $customer->name }} {{ $customer->email }}</td>
        </tr>
        <tr>
            <td>Summe Total: </td>
            <td>{{ $orderParams['amount_received'] }}</td>
        </tr>
        <tr>
            <td>bezahlt am: </td>
            <td>{{ $orderParams['paid_on'] ?? null }}</td>
        </tr>
        <tr>
            <td>Order ID: </td>
            <td>{{ $orderId }}</td>
        </tr>
    </table>
</div>
