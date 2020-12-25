@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header row">
                    <h3>@lang('Dein Einkauf war erfolgreich')</h3>
                </div>
                <div class="card-body row mt-3 p-0 justify-content-center">
                    <div class="col-12">
                        <h3>Danke für den Einkauf</h3>
                        Wir senden Deine von Dir bestellen Artikel sofort per Post an folgende Adresse
                    </div>
                    <div class="col-12">
                        <h3>{{ $customer->name }}</h3>
                        {{ $customer->shipping->street }},&nbsp;
                        {{ $customer->shipping->postcode }} {{ $customer->shipping->city }},&nbsp;
                        {{ $customer->shipping->country }}
                    </div>
                    @if($invoices)
                    <div class="col-12">
                        <h3>Rechnungen</h3>
                        <table class="table table-sm table-borderless">
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{ @date_format($invoice->created, 'd.m.Y H:i') }}</td>
                                    <td>{{ $invoice->description }}</td>
                                    <td>{{ $invoice->total() }}</td>
                                    <td><a href="{{ route('payment.stripe.invoice', ['invoiceId' => $invoice->id]) }}">Download</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
