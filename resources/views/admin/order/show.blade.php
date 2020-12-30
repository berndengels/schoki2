@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('Orders', ['name' => $order->id]))
@section('body')
    <div class="container-xl">
        <h3>Gesamtpreis: {{ $order->price_total }} €</h3>
        <div class="card">
            <div class="p-2 pb-0">
                <h5>Kunde</h5>
                <div>
                    <p>
                        {{ $order->createdBy->name }}, <a href="mailto:{{$order->createdBy->email}}">{{$order->createdBy->email}}</a>
                        <br>
                        {{ $order->createdBy->shipping->street }}, {{ $order->createdBy->shipping->postcode }} {{ $order->createdBy->shipping->city }}
                    </p>
                </div>
            </div>
            <table class="table table-striped table-borderless">
                <tr>
                    <th>ID</th>
                    <th>Artikel</th>
                    <th>Preis</th>
                    <th>Anzahl</th>
                    <th>Summe Preis</th>
                </tr>
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>@brutto($item->product->price) €</td>
                        <td>{{ $item->quantity }} </td>
                        <td>{{ $item->price_total }} €</td>
                    </tr>
                @endforeach
            </table>
        </div>
</div>
@endsection
