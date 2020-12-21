@extends('layouts.public')

@section('extra-headers')
    <script src="{{ asset('js/stripe.js') }}" async></script>
@endsection

@section('title', 'Online Zahlung')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-12">
                <div class="card-header row">
                    <h3 class="my-0 py-0  w-100">Create New Order</h3>
                </div>
                <div class="card-body row mt-3 p-0 justify-content-center">
                    <form id="payment-form" class="w-75 align-middle" method="post"
                          action="{{ route('payment.stripe.process') }}">
                        @csrf
                        <x-inp.text name="name" :value="$name"/>
                        <x-inp.email name="email" :value="$email"/>

                        <!--label for="iban-element">IBAN</label>
                        <div id="iban-element" class="w-50"-->
                        <label id="lblStripeElement"></label>
                        <div id="stripeElement" class="w-100">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>
                        <div id="bank-name" class="w-100 mt-2"></div>
                        <div id="error-message" class="w-100 mt-2"></div>
                        <x-inp.submit name="btnSubmit" value="senden" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

