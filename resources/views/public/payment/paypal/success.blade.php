@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-12">
                <div class="card-header"><h3>@lang('Dein Einkauf war erfolgreich')</h3></div>
                <div class="card-body mt-3 justify-content-center">
                    <h5>Danke für Deine Bestellung</h5>
                    <div class="cols-12">Wir senden Deine von Dir bestellen Artikel sofort per Post an folgende Adresse</div>
                    <div class="cols-12">
                        <h5>
                            {{ $customer->name }},
                            {{ $customer->shipping->street }},&nbsp;
                            {{ $customer->shipping->postcode }} {{ $customer->shipping->city }},&nbsp;
                            {{ $customer->shipping->country }}
                        </h5>
                    </div>
                    <div class="cols-12">
                    @if(isset($order) && $order->orderItems)
                        <h3>Rechnungs Daten</h3>
                        <h5>Gesamt-Preis: {{ $order->price_total }} €</h5>
                        <table class="table table-borderless">
                            <tr>
                                <th>ID</th>
                                <th>Artikel</th>
                                <th>Anzahl</th>
                                <th>Einzelpreis</th>
                                <th>Total</th>
                            </tr>
                            @foreach($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->product->id }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }} Stück</td>
                                    <td>{{ $item->product->price }} €</td>
                                    <td>{{ $item->price_total }} €</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <h5>Leider keine Order Daten verfügbar</h5>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
