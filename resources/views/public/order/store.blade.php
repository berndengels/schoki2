@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header row">Hallo {{ $order->createdBy->name }}!</div>
                <div class="card-body row p-0 justify-content-center">
                    <div>Du hast folgende Artikel bestellt: </div>
                    <table class="table ">
                        @foreach($order->orderItems as $item)
                            <tr>
                                <td>Artikel</td>
                                <td>{{ $item->product->name }}</td>
                            </tr>
                            <tr>
                                <td>Anzahl</td>
                                <td>{{ $item->quantity }}</td>
                            </tr>
                            <tr>
                                <td>Preis</td>
                                <td>{{ $item->product->price }} €</td>
                            </tr>
                            <tr>
                                <td>Summe Preis</td>
                                <td>{{ $item->price_total }}</td>
                            </tr>
                        @endforeach
                    </table>
                    <h3>Gesamtpreis: {{ $order->price_total }} €</h3>
                    <div>
                        <p>Vielen dank für Deinen Einkauf.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

