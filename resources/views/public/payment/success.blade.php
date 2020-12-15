@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-12">
                <div class="card-header row"><h3>@lang('Dein Einkauf war erfolgreich')</h3></div>
                <div class="card-body row mt-3 p-0 justify-content-center">
                    @if($cart && $cart->content() && $cart->content()->count())
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Artikel</th>
                                <th>Preis</th>
                                <th>Anzahl</th>
                                <th>Preis Total</th>
                            </tr>
                            @foreach ($cart->content() as $index => $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>@brutto($item->price) €</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>Total {{ $item->total }} €</td>
                                </tr>
                            @endforeach
                            <tr><td class="text-center align-middle text-light font-weight-bold p-0" colspan="8">
                                    <h4 class="mt-3">Preise Total: {{ $cart->total() }} €</h4></td></tr>
                        </table>
                    @else
                        <h3>Keine Daten vorhanden!</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
