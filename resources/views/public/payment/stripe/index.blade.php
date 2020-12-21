@extends('layouts.public')

@section('extra-headers')
    <script src="{{ asset('js/stripe.js') }}" async></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header row">@lang('Kinds of payments')</div>
                <div class="card-body row p-0 justify-content-center">
                    <div>
                        <form action="/payment/store" method="post" id="payment-form">
                            @csrf
                            <div class="row form-row inline">
                                <div class="col">
                                    <label for="name">Name</label>
                                    <input id="name" name="name" placeholder="Jenny Rosen" required>
                                </div>
                                <div class="col">
                                    <label for="email">Email Address</label>
                                    <input id="email" name="email" type="email" placeholder="jenny.rosen@example.com" required>
                                </div>
                            </div>

                            <div class="row form-row mt-2">
                                <label for="iban-element">IBAN</label>
                                <div id="iban-element" class="col-4">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>
                            </div>
                            <div id="bank-name" class="col-6 mt-1"></div>

                            <button class="btn btn-primary mt-1">Submit Payment</button>
                            <!-- Used to display form errors. -->
                            <div id="error-message" role="alert" class="col-6 mt-2"></div>

                            <!-- Display mandate acceptance text. -->
                            <div id="mandate-acceptance">
                                By providing your IBAN and confirming this payment, you authorise
                                (A) Rocketship Inc.
                                and Stripe, our payment service provider, to send instructions to your bank to
                                debit your account and (B) your bank to debit your account in accordance with
                                those instructions. You are entitled to a refund from your bank under the terms
                                and conditions of your agreement with your bank. A refund must be claimed
                                within 8 weeks starting from the date on which your account was debited.
                            </div>
                        </form>
                    </div>
                </div>
                @if($paymentMethods)
                    <div></div>
                @endif
            </div>
        </div>
    </div>
@endsection
