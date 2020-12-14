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
            <td>{{ $amountReceived }}</td>
        </tr>
        <tr>
            <td>bezahlt: </td>
            <td>{{ $paid ? 'Ja' : 'Nein'}}</td>
        </tr>
    </table>
</div>
