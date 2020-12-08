@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header row">@lang('shopping cart')</div>
                <div class="card-body row p-0 justify-content-center">
                    {{-- dd(get_class_methods($cart)) --}}
                    @if($cart->count() > 0 )
                        {{-- dd( get_class_methods($cart)) --}}
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Artikel</th>
                                <th>Preis</th>
                                <th>Anzahl</th>
                                <th>Preis Total</th>
                                <th colspan="3">&nbsp</th>
                            </tr>
                        @foreach ($cart->content() as $index => $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>Total {{ $item->price * $item->qty }} €</td>
                                <td><form class="d-inline m-0 p-0" action="{{ route( 'public.scard.increment', ['rawId' => $index]) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-link m-0 p-0 small" role="link"><i class="fas fa-plus"></i></button>
                                    </form></td>
                                <td><form class="d-inline m-0 p-0" action="{{ route( 'public.scard.decrement', ['rawId' => $index]) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-link m-0 p-0 small" role="link"><i class="fas fa-minus"></i></button>
                                    </form></td>
                                <td>
                                    <form class="d-inline m-0 p-0" action="{{ route( 'public.scard.destroy', ['rawId' => $index]) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-link m-0 p-0 small" role="link"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                            <tr><td class="text-center align-middle text-primary font-weight-bold p-0" colspan="8">
                                    <h4 class="mt-3">Preise Total: {{ $cart->priceTotal() }} €</h4></td></tr>
                        </table>
                        <div>
                            <a role="button" class="btn btn-block btn-primary" href="{{ route('public.order.create') }}">@lang('Order now')</a>
                        </div>
                    @else
                       <h3>Keine Daten vorhanden!</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
