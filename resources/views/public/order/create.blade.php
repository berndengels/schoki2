@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-12">
                <div class="card-header row"><h3 class="my-0 py-0">Create New Order</h3></div>
                <div class="card-body row mt-3 p-0 justify-content-center">

                    <!-- scard data by session_id -->
                    @if($cart->count() > 0 )
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Movie</th>
                                <th>Preis</th>
                                <th>Anzahl</th>
                                <th>Summe Preis</th>
                            </tr>
                            @foreach ($cart->content() as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->price }} </td>
                                    <td>{{ $item->qty }} </td>
                                    <td>{{ $item->price * $item->qty }} €</td>
                                </tr>
                            @endforeach
                            <tr><td class="text-center align-middle text-primary font-weight-bold p-0" colspan="8">
                                    <h4 class="mt-3">Preise Total: {{ $cart->priceTotal() }} €</h4></td></tr>
                        </table>
                    @else
                        <h3>Der Warenkorb ist leer!</h3>
                    @endif
                    <div>
                        <a role="button" class="btn btn-block btn-primary" href="{{ route('public.payment.billingPortal') }}">@lang('Choose kind of payment')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

