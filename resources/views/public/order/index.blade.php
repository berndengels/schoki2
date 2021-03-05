@extends('layouts.public')

@section('extra-headers')
    <script src="{{ asset('js/payment-stripe.js') }}" async></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card w-75">
                <div class="card-header row">
                    <h3 class="my-0 py-0  w-100">Create New Order</h3>
                </div>
                <div class="card-body mt-3 p-0 justify-content-center">
                    @if($content)
                        <table class="table table-striped table-sm table-borderless">
                            <tr>
                                <th>Artikel</th>
                                <th>Größe</th>
                                <th>Preis</th>
                                <th>Anzahl</th>
                                <th>Summe Preis</th>
                            </tr>
                            @foreach ($content as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ isset($item->options['size']) ? $item->options['size'] : null }}</td>
                                    <td>@brutto($item->price) €</td>
                                    <td>{{ $item->qty }} </td>
                                    <td>Total {{ round(($item->total) * 10)/10 }} €</td>
                                </tr>
                            @endforeach
                            <tr><td class="text-center align-middle text-light font-weight-bold p-0" colspan="5">
                                    <h4 class="mt-3">Preise Total: @round($cart->total()) € + {{ $porto }} € Porto</h4></td></tr>
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

                                    @if(config('my.payment.stripe'))
                                    <form id="frmSubmit" method="post" disabled="true">
                                        @csrf
                                        <button id="submit" role="button"
                                                class="btn btn-primary btnPay align-middle"
                                                type="button"
                                                data-toggle="tooltip" data-placement="top" data-html="true"
                                                title="Bezahlung per<br>EC-Lastschrift (IBAN)<br>Visa, MasterCard">
                                            <span id="start">
                                                <i class="fab fa-cc-stripe mr-2"></i>Summe @round($cart->total()) € + {{ $porto }} € Porto jetzt bezahlen
                                            </span>
                                            <span id="loading" class="align-content-center px-5" style="display:none">
                                                <span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>
                                                <span>Bitte warten ...</span>
                                            </span>
                                        </button>
                                    </form>
                                    @endif
                                    &nbsp;
                                    @if(config('my.payment.paypal'))
                                    <button role="button" name="submit"
                                        class="btn btn-primary ml-2 btnPay align-middle"
                                        data-toggle="tooltip" data-placement="top" data-html="true"
                                            title="Bezahlung per<br>PayPal"
                                        formaction="{{ route('payment.paypal.process') }}">
                                            <i class="fab fa-cc-paypal mr-1"></i>
                                            @lang('Checkout PayPal')
                                    </button>
                                    @endif
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
@section('inline-scripts')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    $('#submit').click(function(e) {
        e.preventDefault();
        $('#start').hide();
        $('#loading').show();
        $(this).attr({disable:true});
        return true;
    });
</script>
@endsection
