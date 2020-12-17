@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-12">
                <div class="card-header row"><h3>@lang('Dein Einkauf war erfolgreich')</h3></div>
                <div class="card-body row mt-3 p-0 justify-content-center">
                    <div>
                        <h5>Danke für den Einkauf</h5>
                        <span>Wir senden Deine von Dir bestellen Artikel sofort per Post an folgende Adresse</span>
                    </div>
                    <div>
                        <h5>{{ $customer->shipping->name }}</h5>
                        <p>
                            {{ $customer->shipping->address->line1 }},&nbsp;
                            {{ $customer->shipping->address->postal_code }} {{ $customer->shipping->address->city }},&nbsp;
                            {{ $customer->shipping->address->country }}
                        </p>
                    </div>
                    <div>
                        <h3>Rechnungen</h3>
                        @if($invoices)
                            <table class="table table-sm table-borderless">
                                <?php
                                /**
                                 * @var Invoice $invoice
                                 */
                                use Stripe\Invoice;
                                ?>
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td>{{ @date_format($invoice->ceated, 'd.m.Y') }}</td>
                                        <td>{{ $invoice->description }}</td>
                                        <td>{{ $invoice->total() }}</td>
                                        <td><a href="{{ route('payment.stripe.invoice', ['invoiceId' => $invoice->id]) }}">Download</a></td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
