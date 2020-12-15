@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card w-75">
                <div class="card-header row">
                    <h3 class="my-0 py-0  w-100">Create New Order</h3>
                </div>
                <div class="card-body mt-3 p-0 justify-content-center">
                    @if($content)
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Movie</th>
                                <th>Preis</th>
                                <th>Anzahl</th>
                                <th>Summe Preis</th>
                            </tr>
                            @foreach ($content as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>@brutto($item->price) €</td>
                                    <td>{{ $item->qty }} </td>
                                    <td>Total {{ $item->total }} €</td>
                                </tr>
                            @endforeach
                            <tr><td class="text-center align-middle text-light font-weight-bold p-0" colspan="8">
                                    <h4 class="mt-3">Preise Total: {{ $cart->total() }} €</h4></td></tr>
                        </table>
                        @if($shippings)
                        <h3>Lieferadresse wählen</h3>
                        <form id="frmCheckout" method="post">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <x-inp.radio label="" name="shipping"
                                         optionsKey="id"
                                         optionsLabel="name"
                                         :options="$shippings"
                                         :value="$shippingDefault"
                                    />

                                    <button role="button" name="submit" class="btn btn-primary btnPay align-middle"
                                        formaction="{{ route('payment.stripe.create') }}" ><i class="fab fa-cc-stripe mr-1"></i>
                                        @lang('Checkout Payment')
                                    </button>
                                    &nbsp;
                                    <button role="button" name="submit" class="btn btn-primary ml-2 btnPay align-middle"
                                        formaction="{{ route('payment.paypal.process') }}"><i class="fab fa-cc-paypal mr-1"></i>
                                        @lang('Checkout PayPal')
                                    </button>
                                </div>
                            </div>
                        </form>
                        @endif
                    @else
                        <h3>Der Warenkorb ist leer!</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

