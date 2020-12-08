<div>
    <h1>Hallo {{ $order->createdBy->name }}!</h1>
    <div>Du hast folgende Artikel bestellt: </div>
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
    <div>Vielen dank für Deinen Einkauf.</div>
</div>
